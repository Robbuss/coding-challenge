<template>
  <div id="app">
    <div class="row">
      <div class="column">
        <Matrix editable :matrix="matrix1" />
      </div>
      <button @click="multiply">Multiply</button>
      <div class="column">
        <Matrix editable :matrix="matrix2" />
      </div>
    </div>
    <template v-if="result.length > 0">
      <h3>Resulting matrix</h3>
      <div class="row result">
        <Matrix :matrix="result" />
      </div>
    </template>
    <div v-else>
      {{ message }}
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Matrix from "./components/Matrix.vue";
import axios from "axios";

@Component({
  components: {
    Matrix,
  },
})
export default class App extends Vue {
  result: number[] = [];
  message = "";

  matrix1 = [
    [1, 2, 3],
    [5, 5, 17],
    [2, 4, 6],
  ];

  matrix2 = [
    [2, 2, 33],
    [2, 4, 12],
    [5, 5, 15],
  ];

  async multiply() {
    try {
      this.result = (
        await axios.post("/matrix/multiply", {
          matrix1: this.matrix1,
          matrix2: this.matrix2,
        })
      ).data;
    } catch (e) {
      this.message = e.message;
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.row {
  display: flex;
}
.column {
  justify-content: center;
  display: flex;
  flex: 50%;
}
.result {
  margin-top: 25px;
  justify-content: center;
}
</style>
