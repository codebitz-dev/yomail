<template>
  <div class="h-full" :class="{ dark: darkMode }">
    <div class="bg-gray-50 dark:bg-gray-800 min-h-full">
      <side-bar @makeActive="makeActive" :activeEmail="activeEmail"></side-bar>

      <div class="fixed top-0 right-0 z-10 mt-4 mr-8">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 inline-block mr-1 text-gray-300"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
          />
        </svg>

        <el-switch
          @change="saveDarkMode"
          v-model="darkMode"
          active-color="#6366f1"
          inactive-color="#e4e7eb"
        >
        </el-switch>
      </div>

      <div class="pl-80 top-0 p-8 w-full mb-4 min-h-full">
        <div class="mx-auto max-w-2xl mt-10">
          <div
            class="
              rounded-xl
              pt-31
              shadow-xl
              h-auto
              w-auto
              bg-white
              dark:bg-gray-900
              overflow-hidden
            "
          >
            <div class="rounded-t-xl p-1 bg-gray-200 handle dark:bg-black">
              <div class="mb-2 ml-2 mt-2">
                <span
                  class="inline-block bg-gray-400 rounded-full w-3 h-3 mr-1"
                ></span>
                <span
                  class="inline-block bg-gray-400 rounded-full w-3 h-3 mr-1"
                ></span>
                <span
                  class="inline-block bg-gray-400 rounded-full w-3 h-3 mr-1"
                ></span>
              </div>
            </div>

            <div v-if="!activeEmail" class="p-8 text-gray-500 text-center">
              Sent emails from your application will appear here.
            </div>

            <div v-else>
              <div
                class="
                  px-4
                  py-1
                  border-b border-1 border-gray-100
                  dark:border-gray-700
                  grid grid-cols-6
                "
              >
                <div
                  class="
                    text-xs text-gray-500
                    col-span-1
                    transform
                    translate-y-1
                  "
                >
                  FROM
                </div>

                <div class="col-span-5">
                  <span
                    class="
                      text-xs
                      bg-blue-100
                      dark:bg-gray-800 dark:text-white
                      px-2
                      py-1
                      rounded
                      mr-2
                    "
                    v-for="(address, index) in activeEmail.from"
                    :key="index"
                  >
                    {{ address.email }}
                  </span>
                </div>
              </div>
              <div
                class="
                  px-4
                  py-1
                  border-b border-1 border-gray-100
                  dark:border-gray-700
                  grid grid-cols-6
                "
              >
                <div
                  class="
                    text-xs text-gray-500
                    col-span-1
                    transform
                    translate-y-1
                  "
                >
                  TO
                </div>

                <div class="col-span-5">
                  <span
                    class="
                      text-xs
                      bg-blue-100
                      dark:bg-gray-800 dark:text-white
                      px-2
                      py-1
                      rounded
                      mr-2
                    "
                    v-for="(address, index) in activeEmail.to"
                    :key="index"
                  >
                    {{ address.email }}
                  </span>
                </div>
              </div>

              <div
                class="
                  px-4
                  py-2
                  border-b border-1 border-gray-100
                  dark:border-gray-700
                  grid grid-cols-6
                "
              >
                <span class="col-span-1 text-xs text-gray-500">SUBJECT</span>

                <div class="col-span-5 text-xs dark:text-white">
                  {{ activeEmail.subject }}
                </div>
              </div>

              <div
                class="
                  px-4
                  py-1
                  border-b border-1 border-gray-100
                  dark:border-gray-700
                  grid grid-cols-6
                "
                v-if="activeEmail.cc"
              >
                <div
                  class="
                    text-xs text-gray-500
                    col-span-1
                    transform
                    translate-y-1
                  "
                >
                  CC
                </div>

                <div class="col-span-5">
                  <span
                    class="
                      text-xs
                      bg-blue-100
                      dark:bg-gray-800 dark:text-white
                      px-2
                      py-1
                      rounded
                      mr-2
                    "
                    v-for="(address, index) in activeEmail.cc"
                    :key="index"
                  >
                    {{ address.email }}
                  </span>
                </div>
              </div>

              <div
                v-if="activeEmail.bcc"
                class="
                  px-4
                  py-1
                  border-b border-1 border-gray-100
                  dark:border-gray-700
                  grid grid-cols-6
                "
              >
                <div
                  class="
                    text-xs text-gray-500
                    col-span-1
                    transform
                    translate-y-1
                  "
                >
                  BCC
                </div>

                <div class="col-span-5">
                  <span
                    class="
                      text-xs
                      bg-blue-100
                      dark:bg-gray-800 dark:text-white
                      px-2
                      py-1
                      rounded
                      mr-2
                    "
                    v-for="(address, index) in activeEmail.bcc"
                    :key="index"
                  >
                    {{ address.email }}
                  </span>
                </div>
              </div>

              <div
                v-if="activeEmail.bcc"
                class="
                  px-4
                  py-1
                  border-b border-1 border-gray-100
                  dark:border-gray-700
                  grid grid-cols-6
                "
              >
                <div
                  class="
                    text-xs text-gray-500
                    col-span-1
                    transform
                    translate-y-1
                  "
                >
                  ATTACHMENTS
                </div>

                <div class="col-span-5">
                  <a
                    :href="attachment.path"
                    target="_blank"
                    class="
                      text-xs
                      bg-blue-100
                      dark:bg-gray-800 dark:text-white
                      hover:bg-blue-200
                      dark:hover:bg-black
                      px-2
                      py-1
                      rounded
                      mr-2
                    "
                    v-for="(attachment, index) in activeEmail.attachments"
                    :key="index"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="
                        h-3
                        w-3
                        transform
                        -translate-y-[1px]
                        inline-block
                        mr-1
                        dark:text-gray-500
                        text-black
                      "
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                      />
                    </svg>
                    {{ attachment.fileName }}
                  </a>
                </div>
              </div>

              <div
                class="
                  relative
                  border-t border-1 border-gray-100
                  bg-[#e4e7eb]
                  dark:bg-black dark:border-gray-700
                  py-2
                  px-4
                "
              >
                <button
                  class="rounded text-gray-500 px-4 py-1 text-sm"
                  :class="{ 'bg-indigo-500 text-white': activeTab == 'html' }"
                  @click.prevent="activeTab = 'html'"
                >
                  HTML
                </button>
                <button
                  class="rounded text-gray-500 px-4 py-1 text-sm"
                  :class="{ 'bg-indigo-500 text-white': activeTab == 'source' }"
                  @click.prevent="activeTab = 'source'"
                >
                  Source
                </button>
                <button
                  class="rounded text-gray-500 px-4 py-1 text-sm"
                  :class="{ 'bg-indigo-500 text-white': activeTab == 'text' }"
                  @click.prevent="activeTab = 'text'"
                >
                  Text
                </button>

                <button
                  class="rounded text-gray-500 px-4 py-1 text-sm"
                  :class="{
                    'bg-indigo-500 text-white': activeTab == 'headers',
                  }"
                  @click.prevent="activeTab = 'headers'"
                >
                  Headers
                </button>

                <p
                  class="
                    dark:text-white
                    absolute
                    right-0
                    top-0
                    text-xs text-gray-500
                    mt-3
                    mr-2
                  "
                >
                  Sent
                  {{ $date(activeEmail.created_at).format("MM/DD/YYYY, h:ma") }}
                </p>
              </div>

              <div>
                <div
                  v-show="activeTab == 'html'"
                  v-html="activeEmail.html"
                ></div>
                <div v-if="activeTab == 'source'">
                  <codemirror
                    ref="myCm"
                    :value="activeEmail.html"
                    :options="{
                      mode: 'text/html',
                      lineNumbers: true,
                      theme: darkMode ? 'base16-dark' : 'base16-light',
                    }"
                  >
                  </codemirror>
                </div>

                <div
                  v-if="activeTab == 'text'"
                  class="whitespace-pre p-4 text-sm text-gray-500"
                >
                  <div v-if="activeEmail.text">
                    {{ activeEmail.text }}
                  </div>

                  <div v-else>No text available for this email</div>
                </div>

                <div v-if="activeTab == 'headers'">
                  <div
                    v-for="header in activeEmail.headers"
                    :key="header"
                    class="
                      border-b border-1 border-gray-100
                      dark:border-gray-700
                      p-4
                      text-gray-500 text-sm
                    "
                  >
                    {{ header }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SideBar from "./sidebar";
import "codemirror/mode/htmlmixed/htmlmixed.js";
export default {
  components: { SideBar },
  data() {
    return {
      activeEmail: false,
      activeTab: "html",
      darkMode: false,
    };
  },
  mounted() {
    if (localStorage.getItem("yomaildark")) {
      this.darkMode = localStorage.getItem("yomaildark") === "true";
    }
  },
  methods: {
    makeActive(email) {
      this.activeEmail = email;
    },
    saveDarkMode() {
      localStorage.setItem("yomaildark", this.darkMode);
    },
  },
};
</script>

<style>
.CodeMirror {
  height: auto !important;
}
</style>
