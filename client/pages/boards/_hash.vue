<template>
  <div class="board">
    <h1>ボード名: {{ board.name }}</h1>
    <div v-show="false">
      <v-text-field
        class="input_board_name"
        v-model="board.name"
        label="ボード名"
        outline
      ></v-text-field>
      <v-btn depressed small>変更</v-btn>
    </div>

    <div class="control">
      <v-textarea
        @keydown.shift.enter="createNewPost"
        v-model="post_text"
        rows="3"
        label="アイデア・質問など"
        outline
      ></v-textarea>
      <p>shift + enterで投稿</p>
      <v-btn depressed small @click="createNewPost">投稿</v-btn>
    </div>

    <div>
      <transition-group tag="ul" class="posts">
        <li v-for="post in board.posts" :key="post.id">
          <p>{{ post.body }}</p>
          <v-btn class="deleteBtn" @click="deletePost(post.id)"
            fab small color="white">
            <v-icon dark>remove</v-icon>
          </v-btn>
          <span class="likeBar" :style="{ height: (post.like_count * 5) + 'px' }"></span>
          <v-btn class="likeBtn" @click="likePost(post.id)"
            flat icon color="yellow">
            <v-icon large>thumb_up</v-icon>
            <span>{{ post.like_count }}</span>
          </v-btn>
        </li>
      </transition-group>
    </div>
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
      this.listenChanel()
    },
    listenChanel() {
      Echo.channel('board.' + this.board.id)
        .listen('PostCreated', (e) => {
          console.log('PostCreated', e)
          this.board.posts.push(e.post)
        })
        .listen('PostLiked', (e) => {
          console.log('PostLiked', e)
          const post = this.board.posts.find(post => post.id == e.post.id)
          post.like_count = e.post.like_count
        })
        .listen('PostDeleted', (e) => {
          console.log('PostDeleted', e)
          this.board.posts = this.board.posts.filter(post => post.id != e.post_id)
        });
    },
    async createNewPost() {
      const response = await this.$axios.$post('http://localhost:8000/api/posts', {
        board_id: this.board.id,
        body: this.post_text
      })
      this.post_text = ""
      console.log('createNewPost', response)
    },
    async likePost(post_id) {
      const response = await this.$axios.$get('http://localhost:8000/api/posts/' + post_id + '/like')
      console.log('likePost', response)
    },
    async deletePost(post_id) {
      const response = await this.$axios.$delete('http://localhost:8000/api/posts/' + post_id)
      console.log('deletePost', response)
    }
  }
}
</script>

<style lang="scss" scoped>
.v-input {
  width: 300px;
  margin: 0 auto;
}
.input_board_name {
  display: inline-block;
}
.control {
  margin: 40px 0;
  p {
    margin-top: -25px;
  }
  .v-btn {
    background: #eac545 !important;
    color: white;
  }
}

.posts {
  display: flex;
  flex-wrap: wrap;
  .v-enter-active, .v-leave-active {
    transition: all 0.5s;
  }
  .v-enter, .v-leave-to {
    opacity: 0;
    transform: translateY(-30px);
  }
  li {
    position: relative;
    width: 150px;
    height: 150px;
    background: #cbb994;
    margin: 10px 15px;
    list-style: none;
    p {
      position: absolute;
      width: 100%;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%,-50%);
      -webkit-transform : translate(-50%,-50%);
      transform : translate(-50%,-50%);
      text-align: center;
      color: white;
      font-weight: bold;
    }
    .deleteBtn {
      position: absolute;
      top: -20px;
      right: -20px;
    }
    .likeBar {
      display: block;
      position: absolute;
      bottom: 0px;
      left: 0px;
      width: 10px;
      background: #eac545;
    }
    .likeBtn {
      position: absolute;
      top: 105px;
      left: 95px;
    }
  }
}
</style>


