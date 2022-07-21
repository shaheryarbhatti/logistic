import VueRouter from 'vue-router';
import Home from  "./components/Home/Home";
import Login from  "./components/Auth/Login";
import TeacherDetail from  "./components/TeacherDetail/TeacherDetail";
import Schedule from  "./components/Schedule/Schedule";

const routes = [
  ///////////////////////////////////////////////////////
  {
    path : '/home',
    name : 'home',
    component : Home
  },
  ///////////////////////////////////////////////////////
  {
    path : '/',
    name : 'login',
    component : Login
  },

  ///////////////////////////////////////////////////////
  {
    path : '/teacher-detail',
    name : 'teacherDetail',
    component : TeacherDetail
  },

  ///////////////////////////////////////////////////////
  {
    path : '/schedules',
    name : 'schedules',
    component : Schedule
  },

];

const router = new VueRouter({
  mode: 'history',
  base: '/logistic/',
  fallback:true,
  routes, // short for `routes: routes`
});

export default router;
