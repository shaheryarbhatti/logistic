<template lang="html">
  <div>

    <Header/>
    <div class="col-md-12 text-justify text-center mt-5">
        <h1 class="">Welcome {{$store.state.user.name}}</h1>
    </div>
    <!-- Content Section -->
    <router-view></router-view>
    <!-- Conten Section End Here -->

  </div>
</template>

<script>
import Header from './components/layout/Header';

export default {
  components:{
    Header,
  },



}
</script>

<style scoped>
</style>
