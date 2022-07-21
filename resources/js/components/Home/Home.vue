<template>
    <div>
        <div class="container">
            <div class="row">
                <div v-if="successmessage" class="alert alert-success col-md-12" role="alert">
                    {{message}}
                </div>
                <div v-if="dangermessage" class="alert alert-danger col-md-12" role="alert">
                    {{message}}
                </div>

                <div class="col-md-12" v-if="add">

                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" v-model="inputs.name" :class="[{'is-invalid': errorFor('name')}]">
                            <v-errors :errors="errorFor('name')"></v-errors>
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control" v-model="inputs.qualification" id="qualification" name="qualification" placeholder="Enter Qualification" :class="[{'is-invalid': errorFor('qualification')}]">
                            <v-errors :errors="errorFor('qualification')"></v-errors>
                        </div>

                        <div class="form-group">
                            <label for="timing">Timing</label>
                            <input type="text" class="form-control" v-model="inputs.timing" id="timing" name="timing" placeholder="Enter Timing" :class="[{'is-invalid': errorFor('timing')}]">
                            <v-errors :errors="errorFor('timing')"></v-errors>
                        </div>

                        <a href="javascript:void(0)" @click="saveTeacherData" class="btn btn-primary">Submit</a>
                        <a href="javascript:void(0)" @click="clearSection" class="btn btn-danger">Clear</a>
                    </form>
                </div>

                <div class="col-md-12" v-if="edit">

                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" v-model="inputs.name" :class="[{'is-invalid': errorFor('name')}]">
                            <v-errors :errors="errorFor('name')"></v-errors>
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control" v-model="inputs.qualification" id="qualification" name="qualification" placeholder="Enter Qualification" :class="[{'is-invalid': errorFor('qualification')}]">
                            <v-errors :errors="errorFor('qualification')"></v-errors>
                        </div>

                        <div class="form-group">
                            <label for="timing">Timing</label>
                            <input type="text" class="form-control" v-model="inputs.timing" id="timing" name="timing" placeholder="Enter Timing" :class="[{'is-invalid': errorFor('timing')}]">
                            <v-errors :errors="errorFor('timing')"></v-errors>
                        </div>

                        <a href="javascript:void(0)" @click="updateTeacherData" class="btn btn-primary">Update</a>
                        <a href="javascript:void(0)" @click="showAddSection" class="btn btn-primary">Add</a>
                    </form>
                </div>

                <div class="col-md-12 mt-5">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qualification</th>
                                <th>Timing</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="showData">
                            <tr v-for="(teacher, index) in teacherData" :key="index">
                                <td>{{teacher['name']}}</td>
                                <td>{{teacher['qualification']}}</td>
                                <td>{{teacher['timing']}}</td>
                                <td><a @click="showEditSection(teacher['name'],teacher['qualification'],teacher['timing'],teacher['id'])" href="javascript:void(0)">Edit</a>
                                    <a class="ml-2" @click="deleteData(teacher['id'])" href="javascript:void(0)">Delete</a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import validationErrors from "../../shared/mixins/validationErrors";
    export default {

        mixins: [validationErrors],

        /*-------------------------------------------------------------------------------
        INITIALIZE DATA
        -------------------------------------------------------------------------------*/
        data() {
            return {
                teacherData: [],
                showData: false,
                successmessage: false,
                dangermessage: false,
                add: true,
                edit: false,
                message: '',
                inputs: {
                    teacher_id: '',
                    name: '',
                    qualification: '',
                    timing: ''

                },

                // price: 0,
            }
        },

        /*-------------------------------------------------------------------------------
        BEFORE CREATE FUNCTIONS
        -------------------------------------------------------------------------------*/

        beforeCreate() {

            if (this.$store.state.isLoggedIn == false) {
                this.$router.push({
                    name: 'login'
                });
            }

        },


        /*-------------------------------------------------------------------------------
        ON CREATE FUNCTIONS
        -------------------------------------------------------------------------------*/
        created() {
            this.getAllTeachers();
        },

        /*-------------------------------------------------------------------------------
        INITIALIZE METHODS FUNCTIONS
        -------------------------------------------------------------------------------*/

        methods: {

            /*-------------------------------------------------------------------------------
            SAVE TEACHER DATA FUNCTION
            -------------------------------------------------------------------------------*/
            async saveTeacherData() {
                try {
                    await axios
                        .post('api/save-teacher', this.inputs) /// this url is define in api.php which is in routes folder ///
                        .then(addresponse => {
                            const result = addresponse.data.status;
                            if (result == 'success') {
                                this.getAllTeachers();
                                this.message = 'Data Added Successfully.';
                                this.successmessage = true;
                                this.clearSection();
                                setTimeout(() => {
                                    this.successmessage = false;
                                }, 3000);

                            }
                        });
                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

            },

            /*-------------------------------------------------------------------------------
            UPDATE TEACHER DATA FUNCTION
            -------------------------------------------------------------------------------*/
            async updateTeacherData() {
                try {
                    await axios
                        .post('api/update-teacher', this.inputs) /// this url is define in api.php which is in routes folder ///
                        .then(addresponse => {
                            const result = addresponse.data.status;
                            if (result == 'success') {
                                this.getAllTeachers();
                                this.message = 'Data Updated Successfully.';
                                this.successmessage = true;
                                this.showAddSection();
                                this.clearSection();
                                setTimeout(() => {
                                    this.successmessage = false;
                                }, 3000);
                            }
                        });
                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

            },

            /*-------------------------------------------------------------------------------
            GET ALL TEACHER FUNCTIONS
            -------------------------------------------------------------------------------*/

            async getAllTeachers() {
                this.edit = false;
                this.add = true;
                await axios
                    .get('api/get-all-teachers') /// this url is define in api.php which is in routes folder ///
                    .then(getresponse => {
                        this.teacherData = getresponse.data.data;
                    }).then(() => {
                        this.showData = true;
                    });
            },

            /*-------------------------------------------------------------------------------
            SHOW EDIT SECTION
            -------------------------------------------------------------------------------*/
            showEditSection(name, qualification, timing, id) {
                this.inputs.name = name;
                this.inputs.qualification = qualification;
                this.inputs.timing = timing;
                this.inputs.teacher_id = id;
                this.edit = true;
                this.add = false;
            },

            /*-------------------------------------------------------------------------------
            CLEAR ADD SECTION
            -------------------------------------------------------------------------------*/
            clearSection() {
                this.inputs.name = '';
                this.inputs.qualification = '';
                this.inputs.timing = '';
                this.inputs.teacher_id = '';
            },

            /*-------------------------------------------------------------------------------
            SHOW ADD SECTION
            -------------------------------------------------------------------------------*/
            showAddSection() {
                this.inputs.name = '';
                this.inputs.qualification = '';
                this.inputs.timing = '';
                this.inputs.teacher_id = '';
                this.edit = false;
                this.add = true;
                this.clearSection();
            },


            /*-------------------------------------------------------------------------------
            DELETE DATA
            -------------------------------------------------------------------------------*/

            async deleteData(id) {
                if (confirm("Do you really want to delete?")) {
                    await axios
                        .get('api/delete-teacher/' + id) /// this url is define in api.php which is in routes folder ///
                        .then(deleteresponse => {
                            const result = deleteresponse.data.status;
                            if (result == 'success') {
                                this.getAllTeachers();
                                this.message = 'Data Deleted Successfully.';
                                this.dangermessage = true;
                                setTimeout(() => {
                                    this.dangermessage = false;
                                }, 3000);
                            }
                        });
                }
            }

        },
    }
</script>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 21px;
        margin: -9px 41px 0 auto;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: black;
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
