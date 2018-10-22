<template>
  <div class="home">
    <img class="logo" alt="hasso logo" src="../assets/logo.png">
    <h2>発想を、爆発させよう</h2>
    <br>
    <h4>ポストイットでブレストする、をオンラインにしました。</h4>
    <div class="create_board">
      <v-text-field
        v-model="board_name"
        label="ボードの名前"
        outline
      ></v-text-field>
      <v-btn depressed small @click="createNewBoard">ボードをつくる</v-btn>
    </div>
  </div>
</template>

<script>
export default{
  // async asyncData({app}){
  //   const data = await app.$axios.$get('http://localhost:8000/api/')
  //   console.log(data)
  // },
  data() {
    return {
      board_name: ""
    }
  },
  created() {
  },
  methods: {
    async createNewBoard() {
      const response = await this.$axios.$post('http://localhost:8000/api/boards', {
        name: this.board_name
      })
      console.log(response)
      this.$router.push({ name: 'boards-hash', params: { hash: response.hash }})
    }
  }
}
</script>

<style lang="scss" scoped>
.logo {
  width: 200px;
  height: 200px;
}
.create_board {
  margin-top: 50px;
  .v-input {
    width: 300px;
    margin: 0 auto;
  }
  .v-btn {
    background: #eac545 !important;
    color: white;
  }
}
</style>