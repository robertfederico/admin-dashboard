<template>
  <div class="card shadow m-4">
    <div class="card-header bg-transparent">
      <div class="d-flex justify-content-between align-items-center">
        <h3>List of Products</h3>
        <button class="btn btn-primary" @click="createProduct()">
          <i class="fas fa-plus-circle"></i> Create
        </button>
      </div>
    </div>
    <div class="card-body px-0 mb-0 pb-0">
      <div class="row pb-3 px-3">
        <div class="col-md-4 offset-md-4">
          <multiselect
            v-model="category"
            :options="categories"
            :searchable="true"
            :close-on-select="true"
            :show-labels="false"
            :allow-empty="true"
            :multiple="false"
            placeholder="Filter by category"
            label="value"
            track-by="id"
            @input="getRecords"
          ></multiselect>
        </div>
        <div class="col-md-4">
          <div class="input-group input-group">
            <input
              v-model="paginationAndFilter.query"
              class="form-control"
              type="input"
              placeholder="Search Product name / category"
              @keyup="getRecords"
            />
          </div>
        </div>
      </div>

      <div class="table-responsive mb-0">
        <product-table
          :products="productList.data"
          :newProduct="newProduct"
          v-on:updateProduct="updateProduct"
          v-on:removeProduct="removeProduct"
        />
      </div>
    </div>

    <div class="card-footer bg-transparent">
      <div class="d-flex justify-content-between align-items-center">
        <table-row-count :paginationAndFilter="paginationAndFilter" />
        <pagination
          :data="productList"
          :limit="2"
          @pagination-change-page="getRecords"
        >
        </pagination>
      </div>
    </div>
  </div>
</template>


<script>
import ProductTable from "./components/ProductTable";
import productCategories from "./categories.json";

export default {
  components: { ProductTable },
  data() {
    return {
      productList: { data: [] },
      category: "",
      newProduct: "",

      paginationAndFilter: {
        current_page: 1,
        item_num: 1,
        per_page: 10,
        sort_field: "id",
        sort_direction: "desc",
        data_per_page: "",
        total_data: "",
        query: "",
      },
      categories: productCategories,
    };
  },
  watch: {
    "$route.params.product_id": {
      handler: function (product_id) {
        if (product_id) {
          this.newProduct = product_id;
        }
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    updateProduct(data) {
      this.$router.push({
        name: "createProduct",
        query: {
          product_id: data.id,
        },
      });
    },
    removeProduct(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Delete",
        })
        .then((result) => {
          if (result.value) {
            axios.delete(`api/products/${id}`).then((result) => {
              if (result) {
                toast.fire({
                  icon: "success",
                  title: "Product removed successfully!",
                });
                this.getRecords();
              }
            });
          }
        });
    },
    createProduct() {
      this.$router.push({
        name: "createProduct",
      });
    },
    getRecords(page = 1) {
      this.$root.isLoading = true;

      let paginationAndFilter = this.paginationAndFilter;
      let category = this.category ? this.category.value : "";

      axios
        .get(
          "/api/products?sort=" +
            paginationAndFilter.sort_field +
            "|" +
            paginationAndFilter.sort_direction +
            "&per_page=" +
            paginationAndFilter.per_page +
            "&page=" +
            page +
            "&name=" +
            paginationAndFilter.query +
            "&category=" +
            category
        )
        .then(({ data }) => {
          this.productList = data;

          paginationAndFilter.current_page = data.meta.current_page;
          paginationAndFilter.item_num = 1;
          paginationAndFilter.item_num =
            data.meta.per_page * (data.meta.current_page - 1) + 1;
          paginationAndFilter.data_per_page = data.data.length - 1;
          paginationAndFilter.total_data = data.meta.total;

          this.$root.isLoading = false;
        })
        .catch((error) => {
          this.$root.isLoading = false;
        });
    },
  },
  created() {
    this.getRecords();
  },
};
</script>

<style lang="scss">
table {
  &.table {
    thead tr th {
      padding: 0.5rem 0 0.5rem 0.3rem;
      text-transform: uppercase;
    }
    tbody tr td {
      padding: 0.4rem 0 0.4rem 0.3rem;
    }
  }
}

.multiselect {
  border-radius: 3px;
  max-height: 35px !important;
  min-height: 35px !important;
  .multiselect__tags {
    padding: 4px 20px 0 4px !important;
    max-height: 35px !important;
    min-height: 35px !important;
    font-size: 14px;

    .multiselect__input,
    .multiselect__single {
      padding: 2px 5px;
      font-size: 14px;
    }
  }

  .multiselect__select {
    width: auto !important;
    border: 0 !important;
    padding: 4px 6px !important;
    max-height: 35px !important;
  }

  .multiselect__input {
    font-size: 14px;
  }
}
</style>