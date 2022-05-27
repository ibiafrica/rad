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
    </style>
</head>

<body style="position:relative;">
    <div id="fakeoverlay">
        <h4>Preparation en cours...</h4>
    </div>

    <!-- <div id="excessoverlay">
        <h4>excess quantity</h4>
    </div> -->
    <div id="ibiposarea">
        <div class="d-flex">
            <div class="d-flex" style="flex:1;height:100vh;">
                <div v-if="!patientData.PATIENT_FILE_CODE" class="over">
                    <div v-if="societes.length == 0">
                        <p>Chargement en cours...</p>
                    </div>
                    <div v-show="societes.length > 0" class="modal" ref="modalref" style="display:block;opacity:0" id="mymodalshow" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informations manquantes sur le patient </h5>
                                    <small class="badge badge-warning">Nouvelle fiche</small>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Choisir la societe d'assurance: </label>

                                        <select class="form-control" v-model="selectedSociete_$c" :disabled="societes.length == 0">
                                            <option :value="ID_SOCIETE" v-for="({ID_SOCIETE, NOM_SOCIETE}) in societes" :selected="selectedSociete == ID_SOCIETE">{{NOM_SOCIETE}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choisir le type de remise pour les medicaments (%): </label>
                                        <select class="form-control" v-model="selectedMed" :disabled="parseInt(selectedSociete) <= 2">
                                            <option :value="ID" v-for="({ID, DESCRIPTION}) in assurances" :selected="selectedMed == ID">
                                                {{DESCRIPTION}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choisir le type de remise pour les materiaux (%) </label>
                                        <select class="form-control" v-model="selectedMatr" :disabled="parseInt(selectedSociete) <= 2">
                                            <option :value="ID" v-for="({ID, DESCRIPTION}) in assurances" :selected="selectedMatr == ID">{{DESCRIPTION}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Numero de bon de commande</label>
                                        <input class="form-control" v-model="bonDeCommande" :disabled="parseInt(selectedSociete) <= 2" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" @click="updatePatientInfo()" class="btn btn-primary" :disabled="selectedSociete > 2 && (selectedMed == '' || selectedMatr == '' || bonDeCommande == '')">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="patientData.PATIENT_FILE_CODE && canCommand == 1" class="d-flex" style="flex:1;height:100vh;">
                    <div style=" flex:1;max-height: 100vh; overflow: hidden; overflow-y:auto;flex-direction:column; align-items:center;">
                        <div style="width: 90%;margin:1rem auto" class="form-group" style="">
                            <p class="text-black">
                                <span style="font-weight:bold">
                                    Nom du client: </span>
                                {{patientInfo}}
                                <span style="margin: 0 2rem;padding: 1rem;font-weight: bold;">
                                    {{patientCode == 'none' ? '' : patientCode}}
                                </span>
                            </p>
                        </div>
                        <sell-area :patient="patientData" :doctors="doctors" :store="storeid" :command="commandid" :status="status" @commandeupdate="updateCommande" @commande="faireCommande" :modifinfo="getModifInfo"></sell-area>
                    </div>
                    <div style="width:50%; padding: 1rem 1rem; border-right: 5px solid #deecec;    overflow-y: auto; overflow-x: hidden;background-color: #f4f4f4;" class="d-flex flex-column">
                        <list-aside :storeid="storeid" @changecategory="changingcategorie"></list-aside>
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

                            <my-items :status="status" :currentoffset="currentOffset" @articlepages="getpages" ref="itemsdiv" :filter="filter" :storeid="storeid" :command="commandOne">
                            </my-items>

                        </div>
                    </div>
                </div>
                <div v-if="area == 'adding' && (canCommand == 0 && !letter && !newFile)">
                    <div class="modal show" style="display: block;" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: rgba(139, 7, 0, 0.64);color: #fff;">
                                    <h5 class=" modal-title">Facture ( /P/ ou /B/ ) non clôturée !</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="color: #666f77;">
                                    <p>Desolé, pour une facture ambulatoire, vous ne pouvez soumettre qu'une seule commande par boutique.</p>
                                    <p>Si vous souhaitez ajouter d'autres produits à cette commande, vous devez la modifier.</p>
                                    <p>Sinon, cliquez sur <b>"Fermer la facture"</b> pour continuer.</p>
                                </div>
                                <div class="modal-footer">
                                    <a :href="toReturnUrl" class="btn" style="background-color: rgb(80, 96, 157);color: #fff;" data-dismiss="modal">Retour</a>
                                    <span class="btn btn-info" data-dismiss="modal" @click="newPatientFile()">Fermer la facture</span>
                                    <a :href="toVentesUrl" class="btn btn-secondary" data-dismiss="modal">Liste des ventes</a>
                                </div>
                            </div>
                        </div>
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
    var ibihostname = `${window.location.protocol}//${window.location.hostname}`;
    window.ibihost = ibihostname;

    setTimeout(() => $('#mymodalshow').css("opacity", 1), 200);
    console.log("my hostname", ibihostname);
</script>

<script type="module">
    import SearchBar from '<?= base_url(); ?>asset/js/extra/vue-components/SearchBar.js';
    import ListAside from '<?= base_url(); ?>asset/js/extra/vue-components/ListAside.js';
    import Items from '<?= base_url(); ?>asset/js/extra/vue-components/MyItems.js';
    import SellArea from '<?= base_url(); ?>asset/js/extra/vue-components/SellArea.js';
    import store from '<?= base_url(); ?>asset/js/extra/vuex-store/index.js';

    var ibiPos = new Vue({
        el: "#ibiposarea",
        store: store,
        data: {
            area: '<?= empty($area) ? '' : $area; ?>',
            storeid: undefined,
            patientData: <?= $patient_data; ?>,
            canCommand: <?= $can_command ?>,
            assuranceLast: <?= $assurance_last; ?>,
            commandInfos: <?= $command_infos; ?>,
            commandOne: <?= empty($command) ? '0' : $command ?>,
            status: 'adding',
            toVentesUrl: "",
            isNewPatientFile: false,
            toReturnUrl: "",
            filter: '',
            assurances: [],
            selectedSociete: '',
            societes: [],
            selectedMed: '',
            selectedMatr: '',
            currentOffset: 1,
            pages: '',
            bonDeCommande: '',
            suivant: 1,
            newFile: false,
            letter: false,
            prev: -1,
            commandid: 0,
            doctors: <?= $doctors; ?>,
            doctors_old: ["PHARMACIE", "NIYONGABO THEODORE", "NDABANEZE EVARISTE", "NIYONGABO ANNABELLE", "HAKIZAYO DESIDERATE", "IRAKOZE Innocente", "BUKURU HELENE", "KAMATARI DIDIER", "NDIHOKUBWAYO ESPERANCE", "SIBOMANA THADEE", "NTAKIRUTIMANA Ezechiel", "MUNEZERO NEWTON TONNY", "BIGIRIMANA BEDE", "NTWARI Armand Michel", "INTUNGANE Axel", "HABONIMANA Aimable", "MUGISHA Guy", "NDERAGAKURA SIXTE", "NYATANYI JACQUELINE", "NIMUBONA STEVE", "MALEBO SHABANI TOTO", "BIVAHAGUMYE LEONARD", "BITANGUMUTWENZI Patrick", "HAVUGINOTI Samuel", "NIYONGABO EDEN", "MANIRAKIZA FRANCOIS XAVIER", "KANKINDI Floride", "ARAKAZA Alexis", "NDAYIRORERE RÈvÈrien"]
        },
        created() {
            const urlLink = (window.location.href).split('/');
            console.log("my store", urlLink);
            this.selectedMatr = this.assuranceLast['MEDICAMENT_MATER'] == "0" ? "1" : this.assuranceLast['MEDICAMENT_MATER'];
            this.selectedMed = this.assuranceLast['MEDICAMENTS'] == "0" ? "1" : this.assuranceLast['MEDICAMENTS'];
            this.selectedSociete = this.assuranceLast['REF_SOCIETE'];
            // == "0" ? "1" : this.assuranceLast['REF_SOCIETE'];

            if (this.area == 'modifier') {
                this.status = 'modifier';
                this.newFile = true;
                this.commandid = parseInt(urlLink[urlLink.length - 1]);
            }

            if (this.patientData.PATIENT_FILE_CODE != null) {
                const letter = this.patientData.PATIENT_FILE_CODE.split("/")[1];
                if (letter.toLowerCase() == 'h') {
                    this.letter = true;
                    this.newFile = true;
                    this.canCommand = 1
                }
            }


            this.storeid = parseInt(urlLink[urlLink.length - 3]);


            this.toVentesUrl = `<?= base_url(); ?>pointdesventes/${this.storeid}/commandes`;
            this.toReturnUrl = `<?= base_url(); ?>pointdesventes/${this.storeid}/index`;

            this.$store.dispatch('itemsStore/saveStore', {
                id: this.storeid
            });
            if (this.commandInfos.length > 0) {
                this.$store.dispatch('itemsStore/populateCart', {
                    items: this.commandInfos
                })
            }
        },
        mounted() {
            this.missingPatientFile();
            const base = "<?= base_url(); ?>";
            var vue = this;
            this.$nextTick(() => {
                if (this.patientData.PATIENT_FILE_CODE) {
                    this.bonDeCommande = this.patientData.BON_DE_COMMANDE;
                    this.$store.dispatch("itemsStore/setClientData", this.patientData);
                }
                setTimeout(() => {
                    document.querySelector('#fakeoverlay').style.display = "none";
                }, 300);
            });

        },
        computed: {
            isNewPatientFile$() {
                return this.isNewPatientFile;
            },
            getModifInfo() {
                return {
                    doctorSelected: this.commandOne.TITRE,
                    descrDB: this.commandOne.DESCRIPTION
                }
            },
            selectedSociete_$c: {
                get: function() {
                    return this.selectedSociete;
                },
                set: function(val) {
                    if (parseInt(val) <= 1) {
                        this.selectedMatr = "1";
                        this.selectedMed = "1";
                    }
                    this.selectedSociete = val;

                }
            },
            patientInfo() {
                const {
                    NOM_PATIENT,
                    PRENOM_PATIENT
                } = this.patientData
                const name = NOM_PATIENT + " " + PRENOM_PATIENT;
                return name;
            },
            patientCode() {
                return this.patientData.PATIENT_FILE_CODE;
            }
        },
        methods: {
            missingPatientFile() {
                const patientMissingInfoUrl = "<?= base_url(); ?>administrator/pointdesventes/patient_missing_info";
                fetch(patientMissingInfoUrl)
                    .then((res) => res.json())
                    .then((data) => {
                        this.assurances = data['assurances'];
                        // this.societes.splice(0, 0, { ID: "0", NOM: "Aucune Sociéte"});

                        this.societes = [...this.societes, ...data['societes']];

                    }).catch(e => {
                        console.log("error occured", e);
                    })

            },
            newPatientFile() {
                //close the current file , then request the new one
                const closeURL = "<?= base_url(); ?>administrator/pointdesventes/patient_close_file/" + this.patientData.PATIENT_FILE_CODE;
                const patientDataUrl = "<?= base_url(); ?>administrator/pointdesventes/get_patient_info/" + this.patientData.ID_PATIENT + "/1";

                fetch(closeURL)
                    .then(res => res.json())
                    .then(data => {
                        if (data == true) {
                            fetch(patientDataUrl)
                                .then(res => res.json())
                                .then(data => {
                                    // this.canCommand = 1;
                                    // this.patientData = data;
                                    // this.isNewPatientFile = true;

                                    // this.$refs.modalref.style.opacity = 1;
                                    window.location.reload();
                                })
                                .catch((e) => {
                                    console.log("error while it", e);
                                })
                        }

                    })
            },
            updatePatientInfo() {
                console.log("i was clicked to update");
                const letter = parseInt(this.selectedSociete) <= 2 ? 'P' : 'B';
                let elMaterial, elMed, discount_material = 0,
                    discount_medicament = 0;
                if (parseInt(this.selectedSociete) > 2) {
                    elMaterial = this.assurances.find(el => el.ID == this.selectedMatr);
                    elMed = this.assurances.find(el => el.ID == this.selectedMed);
                    discount_material = elMaterial.DISCOUNT_PERCENT;
                    discount_medicament = elMed.DISCOUNT_PERCENT;
                }

                this.patientData = {
                    ...this.patientData,
                    medicaments: this.selectedMed,
                    medicament_mater: this.selectedMatr,
                    societe: this.selectedSociete,
                    letter,
                    discount_material,
                    discount_medicament
                };
                this.$store.dispatch("itemsStore/setClientData", this.patientData);
                this.newFile = true;
                this.patientData.PATIENT_FILE_CODE = 'none';
                this.isNewPatientFile = false;
            },
            updateCommande(command) {
                const {
                    order
                } = command;
                const updateUrl = "<?= base_url(); ?>administrator/pointdesventes/update_command/pos_store/";
                const vue = this;
                const letter = this.patientData.PATIENT_FILE_CODE.split("/")[1];
                const toSave = {
                    order: {
                        ...order,
                        CODE: this.commandOne.CODE
                    },
                    letter: letter,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                };
                console.log(toSave);
                return;
                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: toSave,
                    success: function(data) {
                        console.log("success update", data);
                        window.location.href = `<?= base_url(); ?>pointdesventes/${vue.storeid}/commandes`;
                    },
                    error: function(error) {
                        console.log("error occured", error);
                    }
                })
            },
            faireCommande(order) {
                const saveUrl = "<?= base_url(); ?>administrator/pointdesventes/save_order/pos_store";
                // const {ID, patient_file_code, patient_file_id} = this.$store.getters['itemsStore/getPatientData'];
                // const vue = this;
                //     const toSave = {
                // order: {...order, patient_id: ID,
                //      file_code: patient_file_code, 
                //      file_id: patient_file_id},
                const patientData = this.$store.getters['itemsStore/getPatientData'];
                const letter = patientData['PATIENT_FILE_CODE'].split("/")[1];
                const vue = this;
                const toSave = {
                    order: {
                        letter: letter,
                        ...order,
                        ...patientData,
                        bon_de_commande: this.bonDeCommande
                    },

                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                };

                console.log("hey to save", toSave);


                $.ajax({
                    url: saveUrl,
                    method: 'POST',
                    data: toSave,
                    success: function(data) {
                        console.log("success save", data);
                        window.location.href = `<?= base_url(); ?>pointdesventes/${vue.storeid}/commandes`;
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



</html>