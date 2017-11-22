<template>
  <div class="item">
    <div class="item-img">
      <router-link :to="'/bookdetail/' + datas.id">
        <img class="image" :src="datas.img_url">
      </router-link>
    </div>
    <div class="item-title">
      <nobr>{{ datas.book_title }}</nobr>
    </div>
    <div class="item-price">¥ {{ datas.book_price }}</div>
    <div class="item-rate">
      <el-rate :value="parseInt(datas.book_rate)" disabled show-text text-color="#ff9900" text-template="{value}">
      </el-rate>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {

    }
  },
  methods: {

  },
  props: ["datas"]
}

</script>
<style>
.item {
  border: 0px solid black;
  width: 200px;
  display: inline-block;
  margin: 0 0 35px 25px;
}

.item-img {
  padding-left: 50px;
}

.image {
  width: 150px;
  height: 150px;
}

.item-title {
  padding-left: 25px;
  font-weight: 700;
  margin-top: 8px;
  overflow: hidden;
  font-size: 15px;
}

.item-price {
  padding-left: 25px;
  color: #B12704;
  margin: 5px 0;
}

.item-rate {
  padding-left: 25px;
}

</style>
