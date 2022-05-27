<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Point de vente</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('asset/'); ?>css/bootstrap4/main.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <script src="<?= base_url(); ?>asset/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>asset/js/popper.js"></script>
    <script src="<?= base_url(); ?>asset/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>asset/js/extra/promise.js"></script>
    <script src="<?= base_url(); ?>asset/js/extra/vue.js"></script>
    <script src="<?= base_url(); ?>asset/js/extra/vuex.js"></script>
    <style>
        .header-title {
            padding: .3rem 1.5rem;
            color: #fff;
            font-size: 2rem;
            background-color: #033538;
        }

        .logo-lg {
            text-align: center;
            width: 100%;
            display: flex;
            height: 6vh;
            color: white;
            justify-content: center;
            align-items: center;
            font-size: 26px;
        }

        .storeside {
            display: flex;
            padding: 1rem;
            width: 100%;
            color: white;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            border-bottom: 1px #fefefe2b solid;
        }

        .storeside:hover {
            cursor: pointer;
            color: #c1c1c1;
        }

        .page-link {
            background-color: darkcyan !important;
            color: #fff !important;
        }

        .custom-bg {
            background-color: rgb(217, 217, 217);
        }

        .ibimodal {
            position: fixed;

            top: 0;

            right: 0;

            bottom: 0;

            left: 0;
            z-index: 1050;
            overflow: hidden;

            outline: 0;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 1rem;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        table td {
            padding: .3rem .75rem !important;
            font-size: .8rem;
        }

        #fakeoverlay,
        .over {
            position: absolute;
            width: 100vw;
            z-index: 10;
            height: 100vh;
            background-color: #f1f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #mybody {
            opacity: 0
        }
    </style>
</head>

<body style="position:relative;padding: .3px">

    <div id="mybody" style="width: 100vw; height: 100vh; display:flex; justify-content: center; align-items:center">
        <p style="font-size: 24px; font-weight: bold;">Chargement en cours...</p>
    </div>
    <div id="ibiposarea" style="opacity: 0;">
        <div class="d-flex">
            <div class="d-flex" style="flex:1;height:100vh;">

                <div class="d-flex" style="flex:1;height:100vh;">
                    <store-area :type="type"></store-area>

                    <div style="width:45vw; padding: 1rem 1rem; border-right: 5px solid #deecec;    overflow-y: auto; overflow-x: hidden;background-color: #f4f4f4;" class="d-flex flex-column">
                        <list-aside @changecategory="changingcategorie"></list-aside>
                        <search-bar @searching="setFilter"></search-bar>
                        <div style="position:relative;">
                            <breadcrumb></breadcrumb>
                        </div>

                        <div style="">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination d-flex justify-content-between" style="padding: 0 2rem;">
                                    <li v-if="currentOffset > 1" @click.prevent="navigate('moins')" class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Precédent</span>
                                        </a>
                                    </li>
                                    <li class="custom-bg" style="display: flex; padding: 0 1rem; align-items: center;">
                                        {{currentOffset}} page(s) sur {{pages}} restante(s)
                                    <li>
                                    <li v-if="currentOffset < pages" @click.prevent="navigate('plus')" class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="d-flex flex-column" style="max-height: 100vh;position: relative;overflow:auto;padding: 1rem .5rem; padding-bottom:2rem;">

                            <my-items :status="status" :currentoffset="currentOffset" @articlepages="getpages" ref="itemsdiv" :filter="filter" :command="commandOne" :type="type">
                            </my-items>

                        </div>
                    </div>
                    <div style=" flex:1;max-height: 100vh; overflow: hidden; overflow-y:auto;flex-direction:column; align-items:center;">
                        <div class="form-group" :style="[{backgroundColor: commandInf !='' ? type == '1' ?'#00c0ef': '#654747' : '#d5d1d1'}, {color: commandInf !='' ? '#fff' : ''}]" style="padding: .5rem;margin-bottom: 0px;display: flex;justify-content: space-evenly;align-items: center;">
                            <p class="text-black">
                                <span style="font-weight:bold">
                                    Nom du client: </span>
                                {{clientData.NOM_CLIENT}} {{clientData.PRENOM}}
                            </p>
                            <p v-if=" commandInf !=''" class=" text-black">
                                <span style="font-weight:bold">
                                    REF: </span>
                                {{commandInf.CODE}}
                            </p></br>
                            <p>{{commandInf !='' ? type == '1' ? '(Ajout des articles)': '(Retrait des articles)' : ''}}</p>
                        </div>

                        <sell-area :clientdata="clientData" :command="commandid" :status="status" @commandeupdate="updateCommande" @commande="faireCommande"></sell-area>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
</body>
<!-- <script src="<?= base_url(); ?>assets/js/fontkit.js"></script> -->
<script>
    let currentLoc = window.location.href.split("//");
    if (currentLoc[0] == "https:") {
        window.location.href = "http://" + currentLoc[1];
    }
</script>

<script>
    var ibihostname = `${window.location.protocol}//${window.location.hostname}`;
    window.ibihost = ibihostname;

    setTimeout(() => $('#mymodalshow').css("opacity", 1), 200);
    console.log("my hostname", <?= $client_data; ?>);
</script>

<script type="module">
    import SearchBar from '<?= base_url(); ?>asset/js/extra/vue-components/SearchBar.js';
    import ListAside from '<?= base_url(); ?>asset/js/extra/vue-components/ListAside.js';
    import Items from '<?= base_url(); ?>asset/js/extra/vue-components/MyItems.js';
    import SellArea from '<?= base_url(); ?>asset/js/extra/vue-components/SellArea.js';
    import StoreArea from '<?= base_url(); ?>asset/js/extra/vue-components/StoresArea.js';
    import store from '<?= base_url(); ?>asset/js/extra/vuex-store/index.js';

    var ibiPos = new Vue({
        el: "#ibiposarea",
        store: store,
        data: {
            area: '<?= empty($area) ? '' : $area; ?>',
            commandOne: <?= empty($command) ? '0' : $command ?>,
            status: 'adding',
            filter: '',
            commandid: 0,
            pages: '',
            clientData: <?= $client_data; ?>,
            currentOffset: 1,
            commandInfos: [],
            commandInf: <?= empty($commandInfo) ? '' : $commandInfo; ?>,
            type: <?= empty($type) ? '' : $type; ?>,
            prods: <?= $prods; ?>
        },
        created() {
            const urlLink = (window.location.href).split('/');
            this.toVentesUrl = `<?= base_url(); ?>pointdesventes/commandes`;
            this.toReturnUrl = `<?= base_url(); ?>pointdesventes/index`;

            if (parseInt(this.type) == 2) {
                this.$store.dispatch('itemsStore/populateCart', {
                    cmd: this.commandInf.ID_pos_IBI_COMMANDES,
                    creation: this.commandInf.DATE_CREATION_pos_IBI_COMMANDES,
                    items: this.prods
                })
            }
        },
        mounted() {

            const base = "<?= base_url(); ?>";
            this.$nextTick(() => {
                if (this.clientData.CLIENT_FILE_CODE) {
                    this.$store.dispatch("itemsStore/setClientData", this.clientData);
                }
            });
        },
        computed: {},
        methods: {

            updateCommande(command) {

                const updateUrl = "<?= base_url(); ?>administrator/pointdesventes/retrait_command";


                const toSave = {
                    order: {
                        ...command,
                        CODE: this.commandInf.CODE,
                    },
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                };


                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: toSave,
                    success: function(data) {
                        console.log("success update", data);
                        window.location.href = `<?= base_url(); ?>administrator/pos_ibi_commandes`;
                    },
                    error: function(error) {
                        console.log("error occured", error);
                    }
                })
            },
            faireCommande(data) {
                const burl = "<?= base_url(); ?>administrator/pointdesventes/save_order/pos_store";
                const saveUrl = this.commandInf != '' ? burl + '/' + this.commandInf.ID_pos_IBI_COMMANDES : burl;

                const vue = this;
                const toSave = {
                    order: {
                        tableid: data[1],
                        items: data[0],
                        ...this.clientData,
                    },

                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                };

                $.ajax({
                    url: saveUrl,
                    method: 'POST',
                    data: toSave,
                    success: function(data) {
                        console.log("success save", data);
                        window.location.href = `<?= base_url(); ?>administrator/pos_ibi_commandes`;
                    },
                    error: function(data) {
                        console.log("error", data);
                    }
                });
            },
            changingcategorie() {
                this.currentOffset = 1;
            },
            setFilter(value) {
                console.log("set filter is got", value);
                this.currentOffset = 1;
                this.filter = value;
            },
            navigate(direction) {
                if (direction == 'plus') {
                    this.currentOffset += 1;
                } else {
                    this.currentOffset -= 1;
                }
            },
            getpages(value) {
                this.pages = value.pages;
            }
        }
    })
    window.ibiPos = ibiPos;
</script>


<script>
    $(document).ready(() => {
        const body = $("#mybody");
        if (ibiPos.$children.length > 0) {
            body.css("display", "none");
            $("#ibiposarea").css("opacity", 1);
        }
    })();
</script>

</html>