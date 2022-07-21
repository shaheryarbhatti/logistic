<template>

    <div>
        <div class="col-md-12 mt-5">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                      
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Timing</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody v-if="showData">
                    <tr v-for="(schedule, index) in scheduleData" :key="index">
                        <td v-if="schedule['breakoroff']==0">{{schedule['classes']}}</td>
                        <td v-if="schedule['breakoroff']==0">{{schedule['subject']}}</td>
                        <td v-if="schedule['breakoroff']==0">{{schedule['timing']}}</td>
                        <td v-if="schedule['breakoroff']==0">{{schedule['duration']}}</td>
                        <td colspan="4" class="text-center" v-if="schedule['breakoroff']==1">{{schedule['text']}}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    export default {

      data(){
        return{
          scheduleData: [],
          teacher_id: this.$store.state.lastSearch.teacher_id,
          showData: false
        }
      },

      created(){
        this.getTeacherDetail();
      },

      methods:{
        /*-------------------------------------------------------------------------------
        GET TEACHER DETAIL FUNCTION
        -------------------------------------------------------------------------------*/

        async getTeacherDetail() {

            await axios
                .get('api/teacher-detail/'+this.teacher_id) /// this url is define in api.php which is in routes folder ///
                .then(getresponse => {
                    this.scheduleData = getresponse.data.data;
                }).then(() => {
                    this.showData = true;
                });
        },
      }

    }
</script>

<style lang="css" scoped>
</style>
