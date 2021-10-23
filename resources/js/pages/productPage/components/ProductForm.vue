<template>
  <div>
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
            v-model="formData.date_time_created"
            class="form-control"
            id="date_tinme"
            name="birthdaytime"
            :class="hasError('date_time_created') ? 'is-invalid' : ''"
          />

          <div v-if="hasError('date_time_created')" class="invalid-feedback">
            <div class="error" v-if="!$v.formData.date_time_created.required">
              Date and Time is required.
            </div>
          </div>
        </div>
      </tab-content>
    </form-wizard>
  </div>
</template>


<script>
import productCategories from "../categories.json";

import { FormWizard, TabContent, ValidationHelper } from "vue-step-wizard";
import { required } from "vuelidate/lib/validators";

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
        date_time_created: "",
      },
      validationRules: [
        {
          name: { required },
          category: { required },
          description: { required },
        },
        { images: { required } },
        { date_time_created: { required } },
      ],
    };
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
    onComplete() {
      let self = this;
      axios
        .post("/api/products", this.formData)
        .then(({ data }) => {
          //  setTimeout(() => {
          //    this.formData.reset();
          //  }, 0);
          this.storeState.currentTab = 0;
          //  Object.keys(self.formData).forEach(function (key, index) {
          //    self.formData[key] = "";
          //  });

          if (this.$route.query.product_id) {
            this.onUpdate();
          } else {
            // this.onCreate(data);
            this.$emit("onCreate", data);
          }
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style lang="scss" scoped>
</style>