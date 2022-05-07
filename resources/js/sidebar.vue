<template>
  <div
    infinite-wrapper
    class="
      w-72
      fixed
      top-0
      left-0
      overflow-auto
      bg-gray-200
      dark:bg-gray-700
      rounded-xl
      h-[calc(100%-32px)]
      m-4
      scrollbar-thin scrollbar-thumb-indigo-900 scrollbar-track-transparent
      z-10
    "
  >
    <div class="sticky top-0 z-10 bg-gray-200 dark:bg-gray-700">
      <div
        class="
          sticky
          top-0
          z-10
          bg-gradient-to-tr
          p-4
          rounded rounded-b-none
          from-indigo-500
          to-violet-400
          mb-4
          font-bold
          text-yellow-300
        "
      >
        YoMail by
        <a target="_blank" href="https://codebitz.dev"
          ><img
            class="
              inline-block
              w-20
              ml-1
              -mt-1
              transform
              hover:-translate-y-0.5
              transition
            "
            src="https://codebitz.song/img/logo.svg"
            alt=""
        /></a>

        <p class="text-xs text-white mt-1">
          Created by
          <a target="_blank" href="https://twitter.com/aaronlumsden"
            >@aaronlumsden</a
          >
        </p>
      </div>

      <div class="p-4 pt-0">
        <span
          class="font-bold float-left mt-2 dark:text-white"
          v-if="emails.length"
          >Inbox ({{ emailCount }})</span
        >
        <delete-emails
          class="float-right"
          :emails="emails"
          @deleteAllEmails="deleteAllEmails"
        ></delete-emails>
        <div class="clear-both mb-4"></div>

        <div>
          <sidebar-item
            :activeEmail="activeEmail"
            v-for="(email, index) in emails"
            :key="index"
            :email="email"
            @makeActive="makeActive"
          ></sidebar-item>
          <infinite-loading
            @infinite="getEmails"
            :distance="100"
            :forceUseInfiniteWrapper="true"
          >
            <div slot="no-more" class="text-gray-400 text-sm">
              All emails loaded
            </div>
            <div slot="no-results"></div>
          </infinite-loading>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SidebarItem from "./sidebar-item";
import axios from "axios";
import DeleteEmails from "./delete-emails";
import InfiniteLoading from "vue-infinite-loading";
export default {
  components: { SidebarItem, DeleteEmails, InfiniteLoading },
  props: {
    activeEmail: {},
  },
  data() {
    return {
      emails: [],
      timestamp: false,
      page: 1,
      emailCount: 0,
    };
  },
  created() {
    this.getEmails();
    setInterval(() => {
      this.getLatestEmails();
    }, window.yomail.refresh);
  },
  methods: {
    deleteAllEmails() {
      this.emails = [];
      this.timestamp = false;
      this.emailCount = 0;
      this.$emit("makeActive", false);
    },
    getEmails($state) {
      axios
        .get(window.yomail.route + "/emails?page=" + this.page)
        .then((response) => {
          this.emailCount = response.data.total;
          if (response.data.data.length) {
            this.emails.push(...response.data.data);
            this.page += 1;
            if ($state) {
              $state.loaded();
            }
          } else {
            if ($state) {
              $state.complete();
            }
          }

          if (this.emails[0]) {
            this.timestamp = this.emails[0].id;

            this.$emit("makeActive", this.emails[0]);
          }
        });
    },
    getLatestEmails() {
      axios
        .get(
          window.yomail.route + "/emails/refresh?timestamp=" + this.timestamp
        )
        .then((response) => {
          var noActives = false;
          this.emailCount += response.data.count;
          if (this.emails.length == 0) {
            noActives = true;
          }
          this.emails = response.data.emails.concat(this.emails);

          if (this.emails[0]) {
            this.timestamp = this.emails[0].id;
            if (noActives) {
              this.$emit("makeActive", this.emails[0]);
            }
          }
        });
    },
    makeActive(email) {
      this.$emit("makeActive", email);
    },
  },
};
</script>

<style>
</style>
