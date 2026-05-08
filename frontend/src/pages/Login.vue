<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const username = ref('')
const password = ref('')
const error = ref('')
const loading = ref(false)

const router = useRouter()

const login = () => {

  // reset error
  error.value = ''

  // USERNAME & PASSWORD DUMMY
  if (
    username.value === 'admin' &&
    password.value === '123'
  ) {

    loading.value = true

    // efek loading smooth
    setTimeout(() => {

      localStorage.setItem('isLogin', 'true')

      router.push('/home')

    }, 1200)

  } else {

    error.value = 'Username atau password salah'
  }
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-[#f6f1e7] via-[#eef5fa] to-[#fdfaf5] flex items-center justify-center p-8 overflow-hidden">

    <div class="w-full max-w-6xl grid md:grid-cols-2 bg-white/70 backdrop-blur-md rounded-[32px] overflow-hidden shadow-2xl border border-white/40">

      <!-- LEFT SIDE -->
      <div class="relative hidden md:flex flex-col justify-center p-12 bg-[#7da8c3] overflow-hidden">

        <!-- DECORATION -->
        <div class="absolute top-[-50px] right-[-50px] w-52 h-52 bg-white/10 rounded-full"></div>

        <div class="absolute bottom-[-60px] left-[-60px] w-72 h-72 bg-white/10 rounded-full"></div>

        <!-- TITLE -->
        <h1 class="text-5xl font-black text-white leading-tight relative z-10">
          MyShop
        </h1>

        <p class="text-white/80 mt-4 text-lg relative z-10">
          Modern E-Commerce Dashboard
        </p>

        <!-- MOCKUP CARD -->
        <div class="mt-10 space-y-4 relative z-10">

          <!-- CARD 1 -->
          <div class="bg-white/20 backdrop-blur-md rounded-2xl p-5 border border-white/20">

            <div class="flex items-center justify-between">

              <div>
                <p class="text-white/70 text-sm">
                  Total Product
                </p>

                <h2 class="text-3xl font-bold text-white mt-1">
                  13
                </h2>
              </div>

              <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-2xl">
                📦
              </div>

            </div>

          </div>

          <!-- CARD 2 -->
          <div class="bg-white/20 backdrop-blur-md rounded-2xl p-5 border border-white/20">

            <div class="flex items-center justify-between">

              <div>
                <p class="text-white/70 text-sm">
                  Total Transaction
                </p>

                <h2 class="text-3xl font-bold text-white mt-1">
                  11
                </h2>
              </div>

              <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-2xl">
                💳
              </div>

            </div>

          </div>

        </div>

      </div>

      <!-- RIGHT SIDE -->
      <div class="flex items-center justify-center p-8 md:p-12">

        <div class="w-full max-w-md">

          <h2 class="text-4xl font-bold text-[#4b3f35] flex items-center gap-2">
            Welcome
            <span class="text-3xl">😊</span>
        </h2>

          <p class="text-[#7da8c3] mt-2">
            Login to continue dashboard access
          </p>

          <!-- ERROR -->
          <div 
            v-if="error"
            class="bg-red-100 text-red-600 text-sm p-3 rounded-xl mt-5"
          >
            {{ error }}
          </div>

          <!-- USERNAME -->
          <div class="mt-8">

            <label class="text-sm text-[#4b3f35]">
              Username
            </label>

            <input
              v-model="username"
              type="text"
              placeholder="Masukkan username anda"
              class="w-full mt-2 bg-white border border-[#e7dccf] rounded-2xl px-5 py-4 outline-none focus:border-[#7da8c3] transition"
            />

          </div>

          <!-- PASSWORD -->
          <div class="mt-5">

            <label class="text-sm text-[#4b3f35]">
              Password
            </label>

            <input
              v-model="password"
              type="password"
              placeholder="Masukkan password anda"
              class="w-full mt-2 bg-white border border-[#e7dccf] rounded-2xl px-5 py-4 outline-none focus:border-[#7da8c3] transition"
            />

          </div>

          <!-- BUTTON -->
          <button
            @click="login"
            :disabled="loading"
            class="w-full mt-8 bg-[#7da8c3] hover:bg-[#6b97b3] text-white py-4 rounded-2xl font-semibold transition flex items-center justify-center gap-2 shadow-lg shadow-[#7da8c3]/20"
          >

            <!-- SPINNER -->
            <svg
              v-if="loading"
              class="animate-spin h-5 w-5 text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
              ></circle>

              <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8v8H4z"
              ></path>
            </svg>

            <span>
              {{ loading ? 'Loading...' : 'Login' }}
            </span>

          </button>

        </div>

      </div>

    </div>

  </div>
</template>