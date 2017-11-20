<template>
  <div class="vheader">
    <div class="header_con">
      <div class="header_title">iBook Store</div>
      <div class="header_nav">
        <el-menu theme="dark" :router="true" class="el-menu-demo" mode="horizontal" @select="handleSelect">
          <el-menu-item index="/"><i class="el-icon-menu"></i>首页</el-menu-item>
          <el-menu-item index="/highsearch"><i class="el-icon-search"></i>高级搜索</el-menu-item>
          <el-menu-item index="/ranking">销售排行榜</el-menu-item>
          <el-menu-item index="/car" v-if="this.$store.state.islogin">购物车
            <el-badge :value="$store.state.car_count" /></el-menu-item>
          <el-menu-item index="" v-if="!this.$store.state.islogin">【请登录】</el-menu-item>
          <el-submenu index="/user" v-if="this.$store.state.islogin">
            <template slot="title">个人中心</template>
            <el-menu-item index="/">我的信息</el-menu-item>
            <el-menu-item index="/">订单详情</el-menu-item>
            <el-menu-item index="/">退出登录</el-menu-item>
          </el-submenu>
        </el-menu>
      </div>
    </div>
    <Login/>
  </div>
</template>
<script>
import Login from './Login'
export default {
  data() {
    return {
      car_count: 2
    }
  },
  methods: {
    handleSelect(key, keypath) {
      console.log(key, keypath)
      if (key == '') {
        this.$store.commit('loginDialog')
      }
    }
  },
  components: { Login }
}

</script>
<style>
.vheader {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-color: #334258;
  height: 60px;
}

.header_title {
  height: 60px;
  line-height: 60px;
  color: #37e0ec;
  font-size: 22px;
  cursor: default;
  float: left;
  font-weight: 700px;
}

.header_con {
  max-width: 1140px;
  margin: 0 auto;
  padding: 0 20px;
}

.header_nav {
  float: right;
}

</style>
