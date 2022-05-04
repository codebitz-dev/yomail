<template>
  <div
    @click.prevent="makeActive"
    class="
      rounded
      bg-white
      border border-gray-200
      p-4
      mb-2
      dark:bg-gray-700
      dark:border-gray-700
      dark:hover:bg-gray-900
      dark:hover:border-gray-900
      hover-border-gray-800 hover:cursor-pointer hover:border-indigo-300
      pl-10
      relative
    "
    :class="{
      'bg-indigo-100 border-indigo-300 shadow-indigo-500/10 shadow-xl dark:bg-slate dark:border-gray-900 dark:shadow-none dark:bg-slate-900':
        activeEmail.id == email.id,
    }"
  >
    <span
      class="
        block
        absolute
        left-0
        top-0
        ml-4
        mt-8
        w-2
        h-2
        bg-indigo-500
        rounded-full
      "
    ></span>
    <p class="truncate ... text-sm text-gray-500 dark:text-white">
      {{ email.subject }}
    </p>

    <p class="truncate ... text-sm text-indigo-500">{{ email.to[0].email }}</p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: {
    email: {
      required: true,
      type: Object,
    },
    activeEmail: {},
  },
  methods: {
    makeActive() {
      this.$emit("makeActive", this.email);
    },
  },
};
</script>

<style>
</style>
