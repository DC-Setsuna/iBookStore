<template>
  <div>
    <div class="search-bar" @keyup.enter="search()">
      <el-input placeholder="输入关键字查询" v-model="keyword">
        <el-select v-model="select" slot="prepend" placeholder="所有类别">
          <el-option v-for="(value, key) in class_list" :label="key" :value="key"></el-option>
        </el-select>
        <el-button slot="append" icon="search" @click="search()"></el-button>
      </el-input>
    </div>
    <div v-for="data in datas" style="margin:15px 0">
    	<router-link :to="'/bookdetail/' + data.id" style="text-decoration=none; color:#333">
      <el-card>
        <div style="padding:0 10px; line-height: 100px;height:100px;">
        	<nobr>
          <div style="float:left;width:240px;text-align:left;font-size:15px;font-weight:500;" v-html="data.book_title">
          </div></nobr>
          <div style="float:left;height:100px;width:300px;text-align:center;">
            <img :src="data.img_url" height="100">
          </div>
          <div style="float:left;width:150px;text-align:center;"><nobr>
            作者：<span style="font-weight:500;" v-html="data.book_author"></span></nobr>
          </div>
          <div style="float:left;width:150px;text-align:center;">
            售价：<span style="font-weight:500">{{ data.book_price }}</span>
          </div>
          <div style="float:left;width:150px;text-align:center;">
            类别：<span style="font-weight:500">{{ data.book_class }}</span>
          </div>
        </div>
      </el-card></router-link>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      keyword: '',
      select: '',
      class_list: {
        '所有类别': 'all',
        '小说': 'fiction',
        '人文社科': 'humanities',
        '教育': 'education',
        '科技': 'science',
        '生活': 'life',
        '艺术': 'arts'
      },
      datas: {}
    }
  },
  methods: {
    search() {
      this.axios.get(this.$store.state.API + 'search.php', {
        params: {
          cls: this.select,
          keyword: this.keyword
        }
      }).then((response) => {
        if (response.data.code === 200) {
          this.datas = response.data.data
        } else {
        	this.datas = {}
        }
      })
    }
  },
  watch: {
  	select: function() {
  		this.search()
  	}
  }
}

</script>
<style>
.search-bar {
  margin: 20px auto;
  width: 600px;
}

.el-card:hover {
	background-color: #eee;
}
</style>
