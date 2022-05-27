<?php



if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Messages extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function chats_inbox($index = "", $store = "")
    {
        redirect('administrator/messages/chats_inboxs/' . $store . '');
    }

    public function chats_inboxs($store)
    {

        $this->render('backend/standart/administrator/messages/real/chat_index');
    }

    public function create_group_thread()
    {
        $thread_name = $this->input->post('group_name');
        $type = $this->input->post('type');
        if ($type == 1) {
            $name = $thread_name;
            $insert = $this->db->insert('messages_threads', array(
                "NAME_MESSAGE_THREAD" => $name,
                "TYPE_MESSAGE_THREAD" => $type,
                "MEMBERS_MESSAGE_THREAD" => get_user_data('id'),
                "CREATED_BY" => get_user_data('id')
            ));
            $last_id = $this->db->insert_id();
            $data = $this->db->select('*')->from('messages_threads')->where('ID_MESSAGE_THREAD', $last_id)
                ->get()->result();
            $sms =  $this->db->select('*')->from('messages')
                ->where('to_thread_id', $data[0]->ID_MESSAGE_THREAD)
                ->order_by('created_at', 'DESC')
                ->get()->result();

            echo json_encode(array(
                "thread_id" => $data[0]->ID_MESSAGE_THREAD,
                "thread_name" => $data[0]->NAME_MESSAGE_THREAD,
                "members" => $data[0]->MEMBERS_MESSAGE_THREAD,
                "type" => $data[0]->TYPE_MESSAGE_THREAD,
                "last_message_time" => date('Y-m-d h:i:s', time()),
                "messages" => $sms
            ));
            exit;
        }
        echo json_encode([]);
        exit;
    }

    public function create_new_thread($to_user_id, $type)
    {
        $user = $this->db->select('*')->from('aauth_users')->where('id', $to_user_id)->get()->result();

        if (sizeof($user) > 0) {


            $members_composition = $user[0]->full_name . "," .
                get_user_data('full_name');
            $members_composition_ids = $to_user_id . "," . get_user_data('id');

            $inverse_composition_ids =  get_user_data('id') . "," . $to_user_id;

            // check if this composition exist already
            $check = $this->db->select('*')->from('messages_threads')->where("MEMBERS_MESSAGE_THREAD", $members_composition_ids)
                ->or_where("MEMBERS_MESSAGE_THREAD", $inverse_composition_ids)->get()->result();

            if (sizeof($check) == 0) {
                if ($type == 0) {
                    $insert = $this->db->insert('messages_threads', array(
                        "NAME_MESSAGE_THREAD" => $members_composition,
                        "TYPE_MESSAGE_THREAD" => $type,
                        "MEMBERS_MESSAGE_THREAD" => $to_user_id . "," . get_user_data('id'),
                        "CREATED_BY" => get_user_data('id')
                    ));

                    $last_id = $this->db->insert_id();
                    $data = $this->db->select('*')->from('messages_threads')->where('ID_MESSAGE_THREAD', $last_id)
                        ->get()->result();
                    $sms =  $this->db->select('*')->from('messages')
                        ->where('to_thread_id', $data[0]->ID_MESSAGE_THREAD)
                        ->order_by('created_at', 'DESC')
                        ->get()->result();

                    echo json_encode(array(
                        "thread_id" => $data[0]->ID_MESSAGE_THREAD,
                        "thread_name" => $data[0]->NAME_MESSAGE_THREAD,
                        "members" => $data[0]->MEMBERS_MESSAGE_THREAD,
                        "type" => $data[0]->TYPE_MESSAGE_THREAD,
                        "last_message_time" => "",
                        "messages" => $sms
                    ));
                    exit;
                }
                exit;
            } else {
                echo json_encode([]);
            }
        }
        exit;
    }

    public function delete_thread($thread_id)
    {
        $this->db->delete('messages', array("to_thread_id" => $thread_id));
        $this->db->delete('messages_threads', array("ID_MESSAGE_THREAD" => $thread_id));
        echo json_encode(array("deleted" => true));
        exit;
    }
    public function rename_group_thread()
    {
        $thread_id = $this->input->post('thread_id');
        $name = $this->input->post('new_name');
        $array = array("NAME_MESSAGE_THREAD" => $name);
        $this->db->set($array);
        $this->db->where('ID_MESSAGE_THREAD', $thread_id);
        $update =  $this->db->update('messages_threads');
        if ($update == 1) {
            echo json_encode(array("updated" => $update));
            exit;
        } else {
            echo json_encode(array("updated" => false));
            exit;
        }
    }

    public function add_thread_members()
    {
        $thread_id = $this->input->post('thread_id');
        $members = $this->input->post('members');
        $thread = $this->db->select("*")->from("messages_threads")->where("ID_MESSAGE_THREAD", $thread_id);
        if (sizeof($thread) > 0) {
            $array = array(
                "MEMBERS_MESSAGE_THREAD" => $members
            );
            $this->db->set($array);
            $this->db->where('ID_MESSAGE_THREAD', $thread_id);
            $update =  $this->db->update('messages_threads');
            echo json_encode(array("updated" => $update));
            exit;
        } else {
            echo json_encode(array("updated" => 0));
            exit;
        }
    }

    public function get_all_users()
    {
        $users = $this->db->select("*")->from("users")->where('deleted', '0')->where('status', 'active')->get()->result();
        echo json_encode($users);
        exit;
    }

    public function get_thread_info($thread_id)
    {
        $thread = $this->db->select("*")->from('messages_threads')
            ->where('ID_MESSAGE_THREAD', $thread_id)
            ->get()->result();
        echo json_encode($thread[0]);
        exit;
    }


    public function get_all_threads_for_user()
    {
        $user_id = get_user_data('id');
        // $user_id = 5;
        $where_am_in = [];
        $threads = $this->db->select('*')->from('messages_threads')->order_by('ID_MESSAGE_THREAD', 'DESC')->get()->result();
        if (sizeof($threads) > 0) {
            for ($i = 0; $i < sizeof($threads); $i++) {
                $members = explode(',', $threads[$i]->MEMBERS_MESSAGE_THREAD);
                if (in_array($user_id, $members)) {
                    $time = $this->db->select('created_at')->from('messages')
                        ->where('to_thread_id', $threads[$i]->ID_MESSAGE_THREAD)
                        ->order_by('created_at', 'DESC')->limit(1)
                        ->get()->result();
                    $sms =  $this->db->select('*')->from('messages')
                        ->where('to_thread_id', $threads[$i]->ID_MESSAGE_THREAD)
                        ->order_by('created_at', 'DESC')
                        ->get()->result();
                    if ($threads[$i]->TYPE_MESSAGE_THREAD == 1 || $threads[$i]->TYPE_MESSAGE_THREAD == "1") {
                        for ($r = 0; $r < sizeof($sms); $r++) {
                            $from_user = $sms[$r]->from_user_id;
                            $user = $this->db->select('*')->from('aauth_users')->where('id', $from_user)->get()->result();
                            $sms[$r]->sender = $user[0]->full_name;
                        }
                    }

                    array_push($where_am_in, array(
                        "thread_id" => $threads[$i]->ID_MESSAGE_THREAD,
                        "thread_name" => $threads[$i]->NAME_MESSAGE_THREAD,
                        "members" => $threads[$i]->MEMBERS_MESSAGE_THREAD,
                        "type" => $threads[$i]->TYPE_MESSAGE_THREAD,
                        "last_message_time" => $time[0]->created_at,
                        "messages" => $sms
                    ));
                }
            }
        }

        usort($where_am_in, function ($a, $b) {
            $format = 'Y-m-d H:i:s';
            if (empty($a['last_message_time']) || empty($b['last_message_time'])) {
                return 0;
            }

            $date1 = DateTime::createFromFormat($format, $a['last_message_time']);
            $date2 = DateTime::createFromFormat($format, $b['last_message_time']);
            $one = $date1->getTimestamp();
            $two = $date2->getTimestamp();
            return $two - $one;
        });


        echo json_encode($where_am_in);
        exit;
    }

    public function get_me_info(){
        $user_id = get_user_data('id');
        $user_infos = $this->db->select('*')
        ->from('aauth_users')
        ->where('id', $user_id)
        ->join('aauth_user_to_group', 'aauth_user_to_group.user_id = aauth_users.id')
            ->get()->result();
        if(sizeof($user_infos) > 0){
            echo json_encode($user_infos[0]);
            exit;
        }
        exit;
    }

    // public function get_me_info()
    // {
    //     echo json_encode(get_user_data());
    //     exit;
    // }

    public function get_all_messages_for_thread($thread_id)
    {
        $messages = $this->db->select("*")
            ->from("messages")
            ->where("to_thread_id", $thread_id)->order_by('created_at', 'DESC')->get()->result();
        echo json_encode($messages);
        exit;
    }

    // threads must come with the last known message timestamps

    public function get_all_message_real_time()
    {
        $threads_ids_with_last_timestamps = $this->input->get('threads_with_time');

        $response = [];
        for ($i = 0; $i < sizeof($threads_ids_with_last_timestamps); $i++) {
            $data = $threads_ids_with_last_timestamps[$i];

            $fetch_result = $this->db->select("*")
                ->from("messages")
                ->where("to_thread_id", $data->thread_id)
                ->where("created_at >", $data->created_at)
                ->get()->result();
            if (sizeof($fetch_result) > 0) {
                if (!isset($response[$data->thread_id])) {
                    $response[$data->thread_id] = [];
                }
                array_push($response[$data->thread_id], $fetch_result);
            }
        }
        echo json_encode($response);
        exit;
    }

    public function get_all_available_users()
    {
        $all_users = $this->db->select('*')->from('aauth_users')->where('banned', '0')->get()->result();
        echo json_encode($all_users);
        exit;
    }

    public function upload_file_to_temp_custom()
    {
        if (!empty($_FILES)) {
            $temp_file = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];

            if (!is_dir(FCPATH . '/uploads/messages/')) {
                mkdir(FCPATH . '/uploads/messages/');
            }

            $target_path = '/uploads/messages/';
            $stamp = gettimeofday()["sec"];
            $target_file = $stamp . "_" . $file_name;

            if (!is_dir(FCPATH . '/uploads/messages/')) {
                if (!mkdir(FCPATH . '/uploads/messages/', 0777, true)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to create upload folder'
                    ]);
                    exit;
                }
            }

            if (!move_uploaded_file($temp_file, FCPATH . 'uploads/messages/' . $target_file)) {
                echo json_encode([
                    'success' => false,
                    'temp' => $temp_file,
                    'file' => $target_file,
                    'message' => 'Failed to copy upload folder'
                ]);
                exit;
            };
            return $target_file;
        }
    }


    public function new_send_message_file()
    {
        $message_thread_id = $this->input->post('thread_id');
        $message_content = $this->input->post('content');
        $target_file = "uploads/messages/" . $this->upload_file_to_temp_custom();

        $thread = $this->db->select('*')->from('messages_threads')->where('ID_MESSAGE_THREAD', $message_thread_id)
            ->get()->result();

        if (sizeof($thread) > 0) {
            $members = explode(',', $thread[0]->MEMBERS_MESSAGE_THREAD);
            if (in_array(get_user_data('id'), $members)) {
                $message_data = array(
                    "message" => $message_content,
                    "from_user_id" => get_user_data('id'),
                    "to_thread_id" => $message_thread_id,
                    "files" => $target_file,
                    "message_type" => 1,
                    "created_at" => date('Y-m-d H:i:s'),
                    "status" => "unread"
                );
                $this->db->insert('messages', $message_data);
                $last_id = $this->db->insert_id();
                $msg =  $this->db->select('*')->from('messages')->where('id', $last_id)->get()->result();
                $from_user = $msg[0]->from_user_id;
                $user = $this->db->select('*')->from('aauth_users')->where('id', $from_user)->get()->result();
                $msg[0]->sender = $user[0]->full_name;
                echo json_encode($msg[0]);
                exit;
            }
        }
        echo json_encode(array("message" => "Message not send", "thread" => $thread));
        exit;
    }
    public function new_send_message()
    {
        $message_thread_id = $this->input->post('thread_id');
        $message_content = $this->input->post('content');
        // get the current signin user
        // $this->input->post('thread_id');
        $thread = $this->db->select('*')->from('messages_threads')->where('ID_MESSAGE_THREAD', $message_thread_id)
            ->get()->result();

        date_default_timezone_set("Africa/Cairo");

        if (sizeof($thread) > 0) {
            $members = explode(',', $thread[0]->MEMBERS_MESSAGE_THREAD);
            if (in_array(get_user_data('id'), $members)) {
                $message_data = array(
                    "message" => $message_content,
                    "from_user_id" => get_user_data('id'),
                    "to_thread_id" => $message_thread_id,
                    "created_at" => date('Y-m-d H:i:s'),
                    "status" => "unread"
                );
                $this->db->insert('messages', $message_data);
                $last_id = $this->db->insert_id();
                $msg =  $this->db->select('*')->from('messages')->where('id', $last_id)->get()->result();
                $from_user = $msg[0]->from_user_id;
                $user = $this->db->select('*')->from('aauth_users')->where('id', $from_user)->get()->result();
                $msg[0]->sender = $user[0]->full_name;
                echo json_encode($msg[0]);
                exit;
            }
        }
        echo json_encode(array("message" => "Message not send"));
        exit;
    }

    public function setReadMessages($thread_id, $user_id)
    {
        $data = array('status' => 'read');
        $this->db->set($data)->where('to_thread_id', $thread_id)->where('from_user_id !=', $user_id);
        $update =  $this->db->update('messages');
        echo json_encode($update);
        exit;
    }

    public function addToReadGroup($thread_id, $user_id)
    {
        $thread_messages = $this->db->select("*")
            ->from('messages')
            ->where('to_thread_id', $thread_id)
            ->get()->result();

        // $data = array('status' => 'read');
        // $this->db->set($data)->where('to_thread_id', $thread_id)->where('from_user_id !=', $user_id);
        // $update =  $this->db->update('messages');
        // $this->db->set('read_by', 'CONCAT(log,"check")', FALSE);
        // $query = $this->db->where('label_id', 3)->update('labels_table');
        // echo json_encode($update);
        // exit;
    }

    public function fetch_new_msg()
    {

        $threads = $this->input->post('key');
        $threads_data = explode(",", $threads);
        $good_data = [];
        $index = 0;


        while ($index < sizeof($threads_data) / 2) {
            if (!isset($good_data[$index])) {
                $good_data[$index] = [];
            }
            // if ($index % 2 == 0) {
            if (empty($threads_data[$index * 2])) {
                array_push($good_data[$index], $threads_data[($index + 1) * 2]);
                array_push($good_data[$index], $threads_data[(($index + 1) * 2) + 1]);
                $index += 2;
            } else {
                array_push($good_data[$index], $threads_data[$index * 2]);
                array_push($good_data[$index], $threads_data[($index * 2) + 1]);
                $index++;
            }

            // }
        }
        $messages_in = [];

        for ($data = 0; $data < sizeof($good_data); $data++) {
            if (!empty($good_data[$data][0])) {
                if (!isset($messages_in[$data])) {
                    $messages_in[$data] = [];
                }
                $messages = $this->db->select('*')
                    ->from('messages')
                    ->where('created_at >', $good_data[$data][0])
                    ->where('to_thread_id', $good_data[$data][1])
                    ->where('from_user_id !=', get_user_data('id'))
                    ->order_by('created_at', 'ASC')
                    ->get()->result();
                for ($r = 0; $r < sizeof($messages); $r++) {
                    $from_user = $messages[$r]->from_user_id;
                    $user = $this->db->select('*')->from('aauth_users')->where('id', $from_user)->get()->result();
                    $messages[$r]->sender = $user[0]->first_name . " " . $user[0]->last_name;
                }
                $messages_in[$data] = [$good_data[$data][1], $messages];
            }
        }

        echo json_encode($messages_in);
        exit;
    }
}



/* End of file messages.php */

/* Location: ./application/controllers/messages.php */
