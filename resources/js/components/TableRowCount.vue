<template>
  <span
    ><span>showing {{ paginationAndFilter.item_num }}</span> to
    <span>{{
      paginationAndFilter.item_num + paginationAndFilter.data_per_page
    }}</span>
    of
    <span>{{ paginationAndFilter.total_data }} entries</span>
  </span>
</template>

<script>
export default {
  props: ["paginationAndFilter"],
};
</script>