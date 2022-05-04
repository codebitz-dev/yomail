<template>
  <span>
    <button
      v-if="!deleteOpen && emails.length"
      @click.prevent="deleteOpen = !deleteOpen"
      class="
        border
        dark:border-gray-700
        rounded
        p-2
        h-9
        hover:text-red-500 hover:border-red-500 hover:bg-red-100
        text-gray-500
      "
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
        />
      </svg>
    </button>

    <button
      v-else-if="deleteOpen"
      @click.prevent="deleteAll"
      class="
        border
        rounded
        h-9
        p-2
        text-red-500
        border-red-500
        bg-red-100
        text-xs
      "
    >
      Delete all emails
    </button>
  </span>
</template>

<script>
import axios from "axios";
export default {
  props: {
    emails: {},
  },
  data() {
    return {
      deleteOpen: false,
      busy: false,
      form: {
        ids: "all",
      },
    };
  },
  methods: {
    deleteItems() {},
    deleteAll() {
      this.busy = true;
      axios
        .delete(window.yomail.route + "/emails/delete/all")
        .then(() => {
          this.$emit("deleteAllEmails");
        })
        .finally(() => {
          this.busy = false;
          this.deleteOpen = false;
        });
    },
  },
};
</script>

<style>
</style>
