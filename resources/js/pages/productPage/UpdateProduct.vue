<template>
  <div>
    <h6>Update Product</h6>
    <form-wizard @onComplete="onComplete">
      <tab-content title="Step 1" :selected="true">
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            class="form-control"
            :class="hasError('name') ? 'is-invalid' : ''"
            placeholder="Enter your name"
            v-model="formData.name"
          />
          <div v-if="hasError('name')" class="invalid-feedback">
            <div class="error" v-if="!$v.formData.name.required">
              Please provide a valid name.
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select
            class="form-control"
            :class="hasError('category') ? 'is-invalid' : ''"
            v-model="formData.category"
            placeholder="Select Category"
          >
            <option value="">Select Category</option>
            <option
              v-for="(item, key) in categories"
              :key="key"
              :value="item.value"
            >
              {{ item.value }}
            </option>
          </select>
          <div v-if="hasError('category')" class="invalid-feedback">
            <div class="error" v-if="!$v.formData.category.required">
              Category field is required
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <vue-editor
            v-model="formData.description"
            name="editor"
            class="bg-white"
          ></vue-editor>
          <div v-if="hasError('description')" class="invalid-feedback d-block">
            <div class="error" v-if="!$v.formData.description.required">
              Description field is required
            </div>
          </div>
        </div>
      </tab-content>
      <tab-content title="Step 2">
        <div class="form-group">
          <label>Image</label>

          <vue-upload-multiple-image
            @upload-success="uploadImageSuccess"
            @before-remove="beforeRemove"
            @edit-image="editImage"
            :data-images="formData.images"
            dragText="Drag images here (First image will be cover photo)"
            browseText="(First image will be cover photo)"
          >
          </vue-upload-multiple-image>
          <div v-if="hasError('images')" class="invalid-feedback">
            <div class="error" v-if="!$v.formData.images.required">
              Please upload image.
            </div>
          </div>
        </div>
      </tab-content>
      <tab-content title="Step 3">
        <div class="form-group">
          <label class="col-form-label" for="date_tinme">Date and Time</label>

          <input
            type="datetime-local"
            v-model="formData.date_time"
            class="form-control"
            id="date_tinme"
            name="birthdaytime"
            :class="hasError('date_time') ? 'is-invalid' : ''"
          />

          <div v-if="hasError('date_time')" class="invalid-feedback">
            <div class="error" v-if="!$v.formData.date_time.required">
              Date and Time is required.
            </div>
          </div>
        </div>
      </tab-content>
    </form-wizard>
  </div>
</template>


<script>
import { format } from "date-fns";

import productCategories from "./categories.json";

import { FormWizard, TabContent, ValidationHelper } from "vue-step-wizard";
import { required } from "vuelidate/lib/validators";
import { email } from "vuelidate/lib/validators";
import { numeric } from "vuelidate/lib/validators";

export default {
  components: {
    FormWizard,
    TabContent,
  },
  mixins: [ValidationHelper],
  data() {
    return {
      categories: productCategories,
      formData: {
        id: "",
        name: "",
        category: "",
        description: "",
        images: [],
        date_time: "",
      },
      validationRules: [
        {
          name: { required },
          category: { required },
          description: { required },
        },
        { images: { required } },
        { date_time: { required } },
      ],
    };
  },
  watch: {
    "$route.query.product_id": {
      handler: function (product_id) {
        if (product_id) {
          axios
            .get(`/api/products/${product_id}`)
            .then(({ data }) => {
              let date_format = new Date(data.date_time);
              data.date_time = format(date_format, "yyyy-MM-dd'T'HH:mm");
              Object.assign(this.formData, data);
            })
            .catch((err) => {
              console.log(err);
            });
        }
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    uploadImageSuccess(formData, index, fileList) {
      this.formData.images = fileList;
    },
    beforeRemove(index, done, fileList) {
      var r = confirm("remove image");
      if (r == true) {
        done();
      } else {
      }
    },
    editImage(formData, index, fileList) {
      // console.log("edit data", formData, index, fileList);
    },
    onUpdate() {
      toast.fire({
        icon: "success",
        title: "Product updated successfully!",
      });
      // this.$router.push({
      //   name: "products",
      // });
    },
    onCreate(data) {
      toast.fire({
        icon: "success",
        title: "Product created successfully!",
      });
      // this.$router.push({
      //   name: "products",
      //   params: {
      //     product_id: data,
      //   },
      // });
    },
    onComplete() {
      let self = this;
      axios
        .post("/api/products", this.formData)
        .then(({ data }) => {
          Object.keys(self.formData).forEach(function (key, index) {
            self.formData[key] = "";
          });

          if (this.$route.query.product_id) {
            this.onUpdate();
          } else {
            this.onCreate(data);
          }
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style lang="scss" scoped>
</style>