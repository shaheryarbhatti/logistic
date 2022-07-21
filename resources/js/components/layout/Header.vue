<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand ml-5" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div v-if="isLoggedIn" class="collapse navbar-collapse mr-5 ml-5" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{ name: 'home' }">Add Teachers</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'schedules' }">Add Schedule</router-link>

                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link" :to="{ name: 'login'}">Login</router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn"><a class="nav-link" href="javascript:void(0)" @click.prevent="logout"> Logout </a></li>

                </ul>
                <form class="form-inline my-2 my-lg-0">

                    <Select2 class="form-control mr-sm-2" v-model="inputs.teacher_id" :options="teacherData" :settings="{placeholder: 'Select Teacher', settingOption: value, settingOption: value }" @change="onPurposeChange($event)" />
                    <a class="btn btn-outline-success my-2 my-sm-0" href="javascript:void(0)" @click="search">Search</a>
                </form>
            </div>
        </nav>
    </div>

</template>

<script>
    import {
        mapState
    } from "vuex";
    import Select2 from 'v-select2-component';
    export default {
        /*-------------------------------------------------------------------------------
        INITIALIZE COMPONENTS
        -------------------------------------------------------------------------------*/
        components: {
            Select2,
        },
        /*-------------------------------------------------------------------------------
        INITIALIZE OF DATA
        -------------------------------------------------------------------------------*/
        data() {
            return {
                inputs: {
                    teacher_id: '',
                },
                teacherData: [],
                value: '',
            }
        },

        created() {
            this.getAllTeachers();
        },

        /*-------------------------------------------------------------------------------
        BELOW IS THE COMPUTED PROPERTY FUNCTIONS
        -------------------------------------------------------------------------------*/
        computed: {
            ...mapState({
                isLoggedIn: "isLoggedIn"
            }),
        },

        /*-------------------------------------------------------------------------------
        INITIALIZE METHODS
        -------------------------------------------------------------------------------*/

        methods: {

            /*-------------------------------------------------------------------------------
            LOGOUT FUNCTION
            -------------------------------------------------------------------------------*/
            async logout() {
                try {
                    axios.post("logout");
                    this.$store.dispatch("logout");
                    this.$router.push({
                        name: 'login'
                    });
                } catch (error) {
                    this.$store.dispatch("logout");
                }
            },

            /*-------------------------------------------------------------------------------
            SEARCH FUNCTION
            -------------------------------------------------------------------------------*/
            search() {
                this.pageloader = true;
                this.$store.dispatch("setLastSearch", {
                    teacher_id: this.inputs.teacher_id,
                });

                setTimeout(() => {

                    this.pageloader = false;
                    this.$router.push({
                        name: "teacherDetail"
                    });
                }, 1000);

            },


            /*-------------------------------------------------------------------------------
            GET ALL TEACHER FUNCTIONS
            -------------------------------------------------------------------------------*/

            async getAllTeachers() {

                await axios
                    .get('api/get-teachers') /// this url is define in api.php which is in routes folder ///
                    .then(getresponse => {
                        this.teacherData = getresponse.data.teacherdata;
                    })
            },

        },


    }
</script>

<style>
    .select2-container--default {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 42px;
        margin: -9px 41px 0 auto;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: black;
        line-height: 42px;
    }

    .select2-results__option:last-child,
    .select2-results__option:first-child {
        padding-left: 6px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        max-width: 100%;
        align-items: left;
        text-align: center;
    }
</style>
