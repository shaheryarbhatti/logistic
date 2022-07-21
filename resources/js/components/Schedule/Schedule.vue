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
                            <label for="teacher_id">Teacher</label>
                            <Select2 class="form-control mr-sm-2" name="teacher_id" id="teacher_id" v-model="inputs.teacher_id" :options="teacherData" :settings="{placeholder: 'Select Teacher', settingOption: value, settingOption: value }" @change="onPurposeChange($event)" :class="[{'is-invalid': errorFor('teacher_id')}]"/>
                            <v-errors :errors="errorFor('teacher_id')"></v-errors>
                        </div>

                        <div class="form-group">
                            <label for="classes">Class</label>
                            <input type="text" id="classes" name="classes" class="form-control" placeholder="Enter Class" v-model="inputs.classes" :class="[{'is-invalid': errorFor('classes')}]">
                            <v-errors :errors="errorFor('classes')"></v-errors>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" v-model="inputs.subject" id="subject" name="subject" placeholder="Enter Qualification" :class="[{'is-invalid': errorFor('subject')}]">
                            <v-errors :errors="errorFor('subject')"></v-errors>
                        </div>

                        <div class="form-group">
                            <label for="timing">Timing</label>
                            <input type="text" class="form-control" v-model="inputs.timing" id="timing" name="timing" placeholder="Enter Timing" :class="[{'is-invalid': errorFor('timing')}]">
                            <v-errors :errors="errorFor('timing')"></v-errors>
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" v-model="inputs.duration" id="duration" name="duration" placeholder="Enter Duration" :class="[{'is-invalid': errorFor('duration')}]">
                            <v-errors :errors="errorFor('duration')"></v-errors>
                        </div>
                        <div class="form-group">
                            <label for="duration">Break / Off</label>
                            <input type="checkbox" v-model="inputs.breakoroff" id="breakoroff" name="breakoroff">

                        </div>
                        <div class="form-group">
                            <label for="duration">Break / Off Text</label>
                            <input type="text" class="form-control" v-model="inputs.text" id="text" name="text" placeholder="Enter Text">

                        </div>

                        <a href="javascript:void(0)" @click="saveScheduleData" class="btn btn-primary">Submit</a>
                        <a href="javascript:void(0)" @click="clearSection" class="btn btn-danger">Clear</a>
                    </form>
                </div>

                <div class="col-md-12" v-if="edit">

                    <form>
                      <div class="form-group">
                          <label for="teacher_id">Teacher</label>
                          <Select2 class="form-control mr-sm-2" name="teacher_id" id="teacher_id" v-model="inputs.teacher_id" :options="teacherData" :settings="{placeholder: 'Select Teacher', settingOption: value, settingOption: value }" @change="onPurposeChange($event)" :class="[{'is-invalid': errorFor('teacher_id')}]"/>
                          <v-errors :errors="errorFor('teacher_id')"></v-errors>
                      </div>

                      <div class="form-group">
                          <label for="classes">Class</label>
                          <input type="text" id="classes" name="classes" class="form-control" placeholder="Enter Class" v-model="inputs.classes" :class="[{'is-invalid': errorFor('classes')}]">
                          <v-errors :errors="errorFor('classes')"></v-errors>
                      </div>
                      <div class="form-group">
                          <label for="subject">Subject</label>
                          <input type="text" class="form-control" v-model="inputs.subject" id="subject" name="subject" placeholder="Enter Qualification" :class="[{'is-invalid': errorFor('subject')}]">
                          <v-errors :errors="errorFor('subject')"></v-errors>
                      </div>

                      <div class="form-group">
                          <label for="timing">Timing</label>
                          <input type="text" class="form-control" v-model="inputs.timing" id="timing" name="timing" placeholder="Enter Timing" :class="[{'is-invalid': errorFor('timing')}]">
                          <v-errors :errors="errorFor('timing')"></v-errors>
                      </div>

                      <div class="form-group">
                          <label for="duration">Duration</label>
                          <input type="text" class="form-control" v-model="inputs.duration" id="duration" name="duration" placeholder="Enter Duration" :class="[{'is-invalid': errorFor('duration')}]">
                          <v-errors :errors="errorFor('duration')"></v-errors>
                      </div>
                      <div class="form-group" v-if="inputs.breakoroff == 1">
                          <label for="duration">Break / Off</label>
                          <input type="checkbox" v-model="inputs.breakoroff" id="breakoroff" checked name="breakoroff">

                      </div>
                      <div class="form-group" v-if="inputs.breakoroff == 0">
                          <label for="duration">Break / Off</label>
                          <input type="checkbox" v-model="inputs.breakoroff" id="breakoroff" name="breakoroff">

                      </div>
                      <div class="form-group">
                          <label for="duration">Break / Off Text</label>
                          <input type="text" class="form-control" v-model="inputs.text" id="text" name="text" placeholder="Enter Text">

                      </div>

                        <a href="javascript:void(0)" @click="updateTeacherData" class="btn btn-primary">Update</a>
                        <a href="javascript:void(0)" @click="showAddSection" class="btn btn-primary">Add</a>
                    </form>
                </div>

                <div class="col-md-12 mt-5">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Teacher Name</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Timing</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="showData">
                            <tr v-for="(schedule, index) in scheduleData" :key="index">
                                <td>{{schedule['teacher']['name']}}</td>
                                <td v-if="schedule['breakoroff']==0">{{schedule['classes']}}</td>
                                <td v-if="schedule['breakoroff']==0">{{schedule['subject']}}</td>
                                <td v-if="schedule['breakoroff']==0">{{schedule['timing']}}</td>
                                <td v-if="schedule['breakoroff']==0">{{schedule['duration']}}</td>
                                <td colspan="4" class="text-center" v-if="schedule['breakoroff']==1">{{schedule['text']}}</td>
                                <td><a @click="showEditSection(schedule['classes'],schedule['subject'],schedule['timing'],schedule['teacher_id'],schedule['id'],schedule['duration'],schedule['breakoroff'],schedule['text'])" href="javascript:void(0)">Edit</a>
                                    <a class="ml-2" @click="deleteData(schedule['id'])" href="javascript:void(0)">Delete</a>
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
    import Select2 from 'v-select2-component';
    export default {

        mixins: [validationErrors],
        /*-------------------------------------------------------------------------------
        INITIALIZE COMPONENTS
        -------------------------------------------------------------------------------*/
        components: {
            Select2,
        },

        /*-------------------------------------------------------------------------------
        INITIALIZE DATA
        -------------------------------------------------------------------------------*/
        data() {
            return {
                scheduleData: [],
                teacherData: [],
                showData: false,
                successmessage: false,
                dangermessage: false,
                add: true,
                edit: false,
                message: '',
                value: '',
                inputs: {
                    teacher_id: '',
                    schedule_id: '',
                    classes: '',
                    subject: '',
                    timing: '',
                    duration: '',
                    breakoroff: '',
                    text: ''

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
            this.getAllSchedules();
        },

        /*-------------------------------------------------------------------------------
        INITIALIZE METHODS FUNCTIONS
        -------------------------------------------------------------------------------*/

        methods: {

            /*-------------------------------------------------------------------------------
            SAVE TEACHER DATA FUNCTION
            -------------------------------------------------------------------------------*/
            async saveScheduleData() {
                try {
                    await axios
                        .post('api/save-schedule', this.inputs) /// this url is define in api.php which is in routes folder ///
                        .then(addresponse => {
                            const result = addresponse.data.status;
                            if (result == 'success') {
                                this.getAllSchedules();
                                this.message = 'Data Added Successfully.';
                                this.successmessage = true;
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
                        .post('api/update-schedule', this.inputs) /// this url is define in api.php which is in routes folder ///
                        .then(addresponse => {
                            const result = addresponse.data.status;
                            if (result == 'success') {
                                this.getAllSchedules();
                                this.message = 'Data Updated Successfully.';
                                this.successmessage = true;
                                this.showAddSection();
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

            async getAllSchedules() {
                this.edit = false;
                this.add = true;
                await axios
                    .get('api/get-all-schedules') /// this url is define in api.php which is in routes folder ///
                    .then(getresponse => {
                        this.scheduleData = getresponse.data.data;
                        this.teacherData = getresponse.data.teacherdata;
                        // console.log(this.teacherData);
                    }).then(() => {
                        this.showData = true;
                    });
            },

            /*-------------------------------------------------------------------------------
            SHOW EDIT SECTION
            -------------------------------------------------------------------------------*/
            showEditSection(classes, subject, timing, teacher_id,schedule_id,duration,breakoroff,text) {
                this.inputs.classes = classes;
                this.inputs.subject = subject;
                this.inputs.timing = timing;
                this.inputs.teacher_id = teacher_id;
                this.inputs.schedule_id = schedule_id;
                this.inputs.duration = duration;
                if(breakoroff == 0){
                  this.inputs.breakoroff = '';
                }else{
                  this.inputs.breakoroff = breakoroff;
                }
                this.inputs.text = text;
                this.edit = true;
                this.add = false;
            },

            /*-------------------------------------------------------------------------------
            SHOW ADD SECTION
            -------------------------------------------------------------------------------*/
            showAddSection() {
                this.inputs.classes = '';
                this.inputs.subject = '';
                this.inputs.timing = '';
                this.inputs.teacher_id = '';
                this.inputs.schedule_id = '';
                this.inputs.duration = '';
                this.inputs.breakoroff = '';
                this.inputs.text = '';
                this.edit = false;
                this.add = true;
                this.clearSection();
            },

            /*-------------------------------------------------------------------------------
            CLEAR ADD SECTION
            -------------------------------------------------------------------------------*/
            clearSection() {
                this.inputs.classes = '';
                this.inputs.subject = '';
                this.inputs.timing = '';
                this.inputs.teacher_id = '';
                this.inputs.schedule_id = '';
                this.inputs.duration = '';
                this.inputs.breakoroff = '';
                this.inputs.text = '';
            },


            /*-------------------------------------------------------------------------------
            DELETE DATA
            -------------------------------------------------------------------------------*/

            async deleteData(id) {
                if (confirm("Do you really want to delete?")) {
                    await axios
                        .get('api/delete-schedule/' + id) /// this url is define in api.php which is in routes folder ///
                        .then(deleteresponse => {
                            const result = deleteresponse.data.status;
                            if (result == 'success') {
                                this.getAllSchedules();
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
        text-align: left !important;
    }
</style>
