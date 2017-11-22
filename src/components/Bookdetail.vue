<template>
  <transition name="bounce">
    <div style="position:relative;">
      <div class="detail">
        <div style="border-bottom:1px solid #ddd">
          <h2>{{ book_detail.book_title }}</h2>
          <p>
            <span style="margin-right:50px;">
						作者：<span style="font-weight:700; color:#d3660f">{{ book_detail.book_author }}</span>
            </span>
            <span>
						分类：<span style="font-weight:700; color:#d3660f">{{ book_detail.book_class }}</span>
            </span>
          </p>
        </div>
        <div style="border-bottom:1px solid #ddd;padding:20px 0;">
          <div style="
					width: 120px;
					height: 60px;
					line-height: 60px;
					text-align: center;
					font-size: 20px;
					font-weight:700;
					background-color: #eee;
				">
            ¥ {{ book_detail.book_price }}
          </div>
          <p>
            促销信息：
            <el-tag size="medium" type="success">满减优惠</el-tag>
            <el-tag size="medium" type="success">三册享7折</el-tag>
            <el-tag size="medium" type="info" color="#ccc">货到付款</el-tag>
          </p>
          <p>
            购买数量：
            <el-input-number size="small" v-model="count" :min="1"></el-input-number>
          </p>
          <router-link to="/car">
            <el-button type="danger" round>马上购买</el-button>
          </router-link>
          <el-button @click="addcar">加入购物车</el-button>
        </div>
        <div style="width:450px;line-height:1.5em;">
          <p>{{ book_detail.introduce }}</p>
        </div>
        <div style="border-top:1px solid #ddd;">
        	<div style="padding-top:20px;width:500px;margin-bottom: 15px;">
        		<textarea v-model="comment_message" style="width:500px;height:60px;resize:none;outline:none;border-radius:5px;border-color:#ccc;background-color:#eee;"></textarea>
        		<el-button @click="commitComment" type="primary" size="mini" style="float:right;">提交评论</el-button>
        	</div>
        	
        	<h3>评论列表</h3>
        	<div style="width:450px;">
        		<p v-for="comment in comments" style="border-bottom: 1px solid #ddd;margin: 15px 0;">
	        		<span style="font-weight:700;font-size:17px;">{{ comment.username }} : </span>
	        		<span style="font-size:14px;">{{ comment.comment }}</span>
	        	</p>
        	</div>
        	
        </div>
      </div>
      <div class="detail-img">
        <img :src="book_detail.img_url" width="350">
      </div>
    </div>
  </transition>
</template>
<script>

export default {
  data() {
    return {
      book_detail: '',
      count: 1,
      comments: [],
      comment_message: ''
    }
  },
  components: { Comment },
  methods: {
    addcar: function() {
      if (this.$store.state.islogin === false) {
        this.$message.error('请登录！！')
        return
      }
      this.axios.get(this.$store.state.API + 'car.php', {
        params: {
          book_id: this.book_detail.id,
          count: this.count,
          action: 'add',
          username: this.$store.state.username
        }
      }).then((response) => {
        if (response.data['code'] === 200) {
          this.$message({
            message: '添加购物车成功',
            type: 'success'
          })
          this.axios.get(this.$store.state.API + 'car.php', {
            params: {
              action: 'see',
              username: this.$store.state.username
            }
          }).then((response) => {
            if (response.data.code === 200) {
              console.log(response.data.data)
              var len = response.data.data.length
              this.$store.commit('addcar', len)
            }
          })
        } else {
          this.$message.error('添加购物车失败')
        }
      })

    },
    commitComment() {
    	if (!this.$store.state.islogin) {
    		this.$message.error({
    			message: '请先登录！！'
    		})
    		return
    	}
    	this.axios.get(this.$store.state.API + 'comment.php', {
    		params: {
    			action: 'add',
    			username: this.$store.state.username,
    			book_id: this.$route.params.bookid,
    			comment: this.comment_message
    		}
    	}).then((response) => {
    		if (response.data.code === 200) {
    			this.$notify.info({
    				message: '评论成功'
    			})
    			this.comment_message = ''
    			this.getComment()
    		}
    	})
    },
    getComment() {
    	this.axios.get(this.$store.state.API + 'comment.php', {
	    	params: {
	    		book_id: this.$route.params.bookid,
	    		action: 'see'
	    	}
	    }).then((response) => {
	    	console.log(response.data)
	    	this.comments = response.data.data
	    })
    }
  },
  created: function() {
    this.axios.get(this.$store.state.API + 'bookdetail.php', {
      params: {
        bookid: this.$route.params.bookid
      }
    }).then((response) => {
      console.log(response.data['data'])
      this.book_detail = response.data['data']
    })
    this.getComment()
  },
  // beforeRouteLeave (to, from, next) {

  // }
}

</script>
<style>
.detail {
  margin-left: 400px;
  padding: 50px 20px;
}

.detail-img {
  border: 0px solid black;
  position: absolute;
  top: 150px;
  width: 400px;

}

.bounce-enter-active {
  animation: bounce-in .5s;
}

/*.bounce-leave-active {
  animation: bounce-in .5s reverse;
}*/

@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}

</style>
