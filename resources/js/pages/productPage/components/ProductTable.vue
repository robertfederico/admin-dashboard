<template>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Date Time</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody is="transition-group" name="list">
      <tr
        v-for="(item, key) in products"
        :key="key"
        :class="newProduct === item.id ? 'bg-custom' : ''"
      >
        <td class="text-center">
          {{ key + $parent.paginationAndFilter.item_num }}
        </td>
        <td>{{ item.name }}</td>
        <td>{{ item.category }}</td>
        <td>{{ item.description | textSlice | removeHtmlTags }}</td>
        <td>{{ item.date_time }}</td>
        <td>
          <button @click="updateProduct(item)" class="btn btn-sm btn-success">
            <i class="fas fa-pen"></i>
          </button>
          <button class="btn btn-sm btn-danger" @click="removeProduct(item.id)">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["products", "newProduct"],

  methods: {
    updateProduct(data) {
      this.$emit("updateProduct", data);
    },
    removeProduct(id) {
      this.$emit("removeProduct", id);
    },
  },
};
</script>

<style lang="scss" scoped>
// .bg-custom {
//   transition: all 5s;
//   background: yellow;
// }

.bg-custom {
  -webkit-animation: seconds 1s forwards;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-delay: 5s;
  animation: seconds 1s forwards;
  animation-iteration-count: 1;
  animation-delay: 5s;
  position: relative;
  background: #00e676;
}
@-webkit-keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    background: transparent;
  }
}
@keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    background: transparent;
  }
}
</style>