<template>
  <div class="matrix">
    <div class="row" v-for="(row, i) in matrix" :key="i">
      <div class="cell" v-for="(col, j) in matrix[i]" :key="j">
        <template v-if="editable !== false">
          <input type="number" v-model="matrix[i][j]" />
        </template>
        <template v-else>
          {{ col }}
        </template>
      </div>
    </div>
  </div>
</template>

<style scoped>
.matrix .row {
  height: 40px;
}
.matrix .cell {
  margin: 5px;
  border: 1px solid grey;
  display: inline;
  padding: 5px;
  min-width: 50px;
  text-align: center;
}
</style>

<script lang="ts">
import { Component, Vue, Prop } from "vue-property-decorator";

@Component({})
export default class Matrix extends Vue {
  @Prop({ default: false })
  editable: boolean;

  @Prop()
  matrix: number[][];
}
</script>