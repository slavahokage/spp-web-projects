<template>
  <li class="w3-padding-16" style="height:80px">
    <router-link :to="{ name : 'post.show' ,  params :  { post_slug : post.slug, post_id : post.id } }">
      <span class="w3-small">{{post.title}}</span><br>
      <span>{{post.description}}</span>
    </router-link>
  </li>
</template>

<script>
export default {
  props: ['post']
}
</script>

<style scoped>

</style>
