import Vue from 'vue';
import VueRouter from 'vue-router';
import PostList from '../components/PostList.vue';
import Post from '../components/Post.vue';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import AddPost from '../components/AddPost.vue';
import EditPost from '../components/EditPost.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: PostList,
    name: 'post.index'
  },
  {
    path: '/posts/:post_slug/:post_id',
    component: Post,
    name: 'post.show',
    props: true
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
  },
  {
    path: '/register',
    component: Register,
    name: 'register',
  },
  {
    path: '/addPost',
    component: AddPost,
    name: 'addPost',
  },
  {
    path: '/editPost',
    component: EditPost,
    name: 'editPost',
  },
  {
    path: '*',
    redirect: '/'
  }
];

export default new VueRouter({
  routes,
  mode: 'history',
  linkActiveClass: 'active',
});