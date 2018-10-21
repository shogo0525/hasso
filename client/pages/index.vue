<template>
  <div class="home">
    <h2>発想を、爆発させよう</h2>
    <br>
    <h4>ポストイットでブレストする、をオンラインにしました。</h4>
    <div class="create_board">
      <input type="text" v-model="board_name">
      <button @click="createNewBoard">ボードをつくる</button>
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
      const board = await this.$axios.$post('http://localhost:8000/api/boards', {
        name: this.board_name
      })
      this.$router.push({ name: 'boards-id', params: { id: board.id }})
    }
  }
}
</script>