<template>
	<div>
		<div v-for="data in datas" style="margin:15px 0">
			<router-link :to="'/bookdetail/' + data.id" style="text-decoration=none; color:#333">
			<el-card>
				<div style="padding:0 10px; line-height: 100px;height:100px;">
					<div style="float:left;width:40px;text-align:center;color:#B12704;font-size:20px;font-weight:700;">
						{{ datas.indexOf(data) + 1 }}
					</div>
					<div style="float:left;height:100px;width:300px;text-align:center;">
						<img :src="data.img_url" height="100">
					</div>
					<div style="float:left;width:150px;text-align:center;">
						作者：<span style="font-weight:500;">{{ data.book_author }}</span>
					</div>
					<div style="float:left;width:150px;text-align:center;">
						售价：<span style="font-weight:500">{{ data.book_price }}</span>
					</div>
					<div style="float:left;width:150px;text-align:center;">
						类别：<span style="font-weight:500">{{ data.book_class }}</span>
					</div>
				</div>
			</el-card>
		</router-link>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			datas: []
		}
	},
	methods: {

	},
	created: function() {
		this.axios.get(this.$store.state.API + 'ranking.php').then((response) => {
			console.log(response.data)
			this.datas = response.data.data
		})
	}
}
</script>
<style>
.el-card:hover {
	background-color: #eee;
}
</style>