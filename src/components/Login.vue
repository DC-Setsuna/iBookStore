<template>
	<el-dialog title="iBook Store Login" :visible="this.$store.state.loginDialogVisible" :show-close="false">
	  <el-tabs type="card" >
	  	<el-tab-pane label="登录">
	  		
	  	</el-tab-pane>
	  	<el-tab-pane label="注册">
	  		
	  	</el-tab-pane>
	  </el-tabs>
	  <div slot="footer" class="dialog-footer">
	    <el-button @click="closeDialog">取 消</el-button>
	    <el-button type="primary" @click="closeDialog">确 定</el-button>
	  </div>
	</el-dialog>
</template>
<script>
export default {
	data() {
		return{
			formLabelWidth: '120px',
			form: {
	          
	        }
		}
	},
	methods: {
		closeDialog: function() {
			this.$store.commit('loginDialog')
		}
	}
}
</script>
<style>
.el-tabs__nav {
	width: 100%;
}
.el-tabs__item {
	width: 50%;
	text-align: center;
}
</style>
