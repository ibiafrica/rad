<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js">

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js" integrity="sha512-Q1f3TS3vSt1jQ8AwP2OuenztnLU6LwxgyyYOG1jgMW/cbEMHps/3wjvnl1P3WTrF3chJUWEoxDUEjMxDV8pujg==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/vuex@2.0.0"></script>

<style>
    div {
        color: #000;
    }

    .timestamp {
        opacity: 0;
        right: -7rem;
        padding: 0 !important;
        min-width: 8rem;
    }

    .timestamp-inverse {
        opacity: 0;
        left: -7rem;
        padding: 0 !important;
        min-width: 8rem;
    }

    .sms-block:hover>.timestamp-inverse {
        display: block;

        left: 0;
        opacity: 1;

        transition: all .3s ease-in-out;

        padding: 0.25rem !important;

        bottom: -2rem;
        max-width: 11rem;
    }


    .sms-block:hover>.timestamp {
        /* display: block; */
        display: block;
        /* right: -9rem; */
        right: 0;
        opacity: 1;
        /* opacity: 1; */
        transition: all .3s ease-in-out;
        /* transition: all .3s ease-in-out; */
        padding: 0.25rem !important;
        /* padding: 0.25rem !important; */
        bottom: -2rem;
        max-width: 11rem;
    }

    .bg-my-chat {
        background-color: #83babd63;
    }

    .convo:hover {
        background-color: #e5e9ec;
    }

    .main_chat_wrapper {
        display: grid;

    }

    .convo:hover>.convo-edit {
        display: flex !important;
    }
</style>
<div class="main_chat_wrapper" style="background-color:#e5e9ec">
    <!-- <main  style="display: flex;height: 93vh;overflow-y:hidden;padding: 2rem 0">
        <side-view @initview="initView()" :me="me" @switchthread="changeThread($event)"></side-view>
        <main-view :threadid="selectedThread" @addtogroup="addToGroup($event)" v-show="!!selectedThread" :me="me" :convoname="convoName" @sendmessagewithfile="sendmessagewithfile($event)" :members="members" :realmembers="realmembers" :threadtype="threadtype" :messages="messagesOfThread_$" @sendmessage="sendMessage($event)"></main-view>
    </main> -->
    <main id="try" class="flex justify-around p-10" style="height: 90vh">
        <side-view @initview="initView()" :me="me" @switchthread="changeThread($event)"></side-view>
        <main-view ref="main" :threadid="selectedThread" @addtogroup="addToGroup($event)" :me="me" :convoname="convoName" @sendmessagewithfile="sendmessagewithfile($event)" :members="members" :realmembers="realmembers" :threadtype="threadtype" :messages="messagesOfThread_$" @sendmessage="sendMessage($event)"></main-view>
    </main>
</div>

<script type="module">
    import MainComponent from "<?= base_url('assets/chat/mainview/index.js'); ?>";
    import SideComponent from "<?= base_url('assets/chat/sideview/index.js'); ?>";
    
    new Vue({
        el: "#try",
        data(){
            return{
                messagesOfThread:[],
                me: '',
                selectedThread: undefined,
                threadtype: undefined,
                convoName: '',
                members:[],
                realmembers:[],
            };
        },
        created() {
            setTimeout(() =>this.fetchMeInfo() ,2000);
        },
        computed:{
            messagesOfThread_$(){
                return this.messagesOfThread
            }
        },
        methods:{
            fetchMeInfo(){
                const url = `${base_url}/get_me_info`;
                console.log(url);
                
                fetch(url)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    this.me = data;
                })
            },
            initView(){
                this.selectedThread = undefined;
            },
            addToGroup(event){
                console.log("the one to add to group array", event)
            },
            changeThread(event){
                this.selectedThread = event[0];
                this.messagesOfThread = event[1];
                this.threadtype = event[3];
                this.convoName = event[4];
                this.members = event[2].split(',');
                this.realmembers = JSON.parse(JSON.stringify(event[2].split(',')));
                const mainViewEl = this.$refs.main.$el;
                $(mainViewEl).scrollTop(-250);
                console.log(this.$refs.main.$el);
                // if(th)
                // fetch(`${base_url}/get_all_messages_for_thread/${event}`)
                // .then(res=>res.json())
                // .then(data => {
                //     this.messagesOfThread = data;
                //     console.log("this is the data", data);
                // })
            },
            async sendmessagewithfile(messagewithfile){
                
                
                if(true) {
                    const postMessageUrl = `${base_url}/new_send_message_file`;
                        const myVue = this;
                    setTimeout(() => {
                        $.ajax({
                            method: 'POST',
                            url: postMessageUrl,
                            processData: false,
                            contentType: false,
                            data: messagewithfile,
                        }).success(function (data){
                            
                        const message = JSON.parse(data);
                        myVue.$refs.main.selectedfiles = [];
                        myVue.$refs.main.withfile = false;
                        myVue.$refs.main.correctFile = false;
                        console.log("success data", message);
                        myVue.messagesOfThread.unshift(message);
                        }).error(function(err){
                            console.log("err data", err);
                        })
                    },10); 
                }
            },
            async sendMessage(message){
                if(message.trim().length > 0) {
                    const postMessageUrl = `${base_url}/new_send_message`;
                    const myVue = this;
                    setTimeout(() => {
                        $.ajax({
                            method: 'POST',
                            url: postMessageUrl,
                            data: {
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                thread_id: this.selectedThread,
                                content: message
                            }
                        }).success(function (data){
                            
                        const message = JSON.parse(data);
                        console.log("success data", message);
                        myVue.messagesOfThread.unshift(message);
                        }).error(function(err){
                            console.log("err data", err);
                        })
                    },10); 
                }
                
            }
        }
    })
</script>