<template>
  <div id="app" >
    <Vheader/>
    <router-view class="main-view"></router-view>
  </div>
</template>

<script>
import Vheader from './components/Vheader'

export default {
  name: 'app',
  components: { Vheader }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.main-view {
  margin: 0 auto;
  padding: 0 20px 20px 0;
  max-width: 1140px;
}
</style>
