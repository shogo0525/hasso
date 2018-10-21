<template>
  <div class="board">
    <h1>ボード名: {{ board.name }}</h1>
    <input type="text" v-model="post_text">
    <button @click="createNewPost">投稿</button>

    <ul>
      <li v-for="post in board.posts" :key="post.id">{{ post.body }}</li>
    </ul>
  </div>
</template>

<script>
export default{
  data() {
    return {
      board: {},
      post_text: ""
    }
  },
  created() {
    this.getBoard()
  },
  methods: {
    async getBoard() {
      const response = await this.$axios.$get('http://localhost:8000/api/boards/' + this.$route.params.hash)
      this.board = response
    },
    async createNewPost() {
      const response = await this.$axios.$post('http://localhost:8000/api/posts', {
        board_id: this.board.id,
        body: this.post_text
      })
      console.log(response)
    }
  }
}
</script>


