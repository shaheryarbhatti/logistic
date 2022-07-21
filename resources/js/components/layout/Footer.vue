<template>
  <div>
    <!-- Footer Start -->
    <footer class="acr-footer footer-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-12 footer-widget">
            <div class="footer-logo" v-if="socialshow"><img :src="$backendURL+'public/backend/assets/website_info_images/'+footerData[0]['images']" alt="logo"></div>
            <p v-if="show" v-html="footerData[0]['description']"></p>
            <ul class="social-media" v-if="socialshow" v-html="footersocialData[0]['description']">

            </ul>
          </div>
          <div class="col-lg-2 offset-md-1 col-md-4 col-sm-6 footer-widget">
            <h5 class="widget-title">Menu</h5>
            <ul>
              <li> <a href="home-v4.html#">Find Home</a> </li>
              <li> <a href="home-v4.html#">Add Listing</a> </li>
              <li> <a href="home-v4.html#">Listings</a> </li>
              <li> <a href="home-v4.html#">Blog</a> </li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-6 footer-widget">
            <h5 class="widget-title">Legal</h5>
            <ul>
              <li> <a href="home-v4.html#">Privacy Policy</a> </li>
              <li> <a href="home-v4.html#">Refund Policy</a> </li>
              <li> <a href="home-v4.html#">Cookie Policy</a> </li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-12 footer-widget">
            <h5 class="widget-title">Newsletter</h5>
            <p>Join our newsletter today, and get the best flats that we have to offer.</p>
            <form method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email Address" name="newsletter-email" value="">
              </div>
              <button type="submit" class="btn-custom primary light btn-block" name="button">Join Newsletter</button>
            </form>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-lg-7">
              <p class="m-0">&copy; Copyright 2020 - <a href="home-v4.html#">AndroThemes</a> All Rights Reserved.</p>
            </div>
            <div class="col-lg-5">
              <ul>
                <li> <a href="home-v4.html#">Find a Home</a> </li>
                <li> <a href="home-v4.html#">Add Listing</a> </li>
                <li> <a href="home-v4.html#">View Brokers</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </footer>
    <!-- Footer End -->

  </div>
</template>

<script>
export default {
  data(){
    return {
      footerData: [],
      footersocialData: [],
      page: 'footer',
      permalink: 'footer-logo',
      socialpermalink: 'footer-social-link',
      show: false,
      socialshow: false,
    }
  },
  async created(){
    await axios
    .get('api/home/'+this.page+'/'+this.permalink) /// this url is define in api.php which is in routes folder ///
    .then(response =>{
      this.footerData = response.data.data;
    }).then(()=>{
      this.show = true;
    });

    await axios
    .get('api/home/'+this.page+'/'+this.socialpermalink) /// this url is define in api.php which is in routes folder ///
    .then(socialresponse =>{
      this.footersocialData = socialresponse.data.data;
    }).then(()=>{
      this.socialshow = true;
    });
  }
}
</script>

<style  scoped>
.acr-footer {
  margin-top: 30px !important;
}
</style>
