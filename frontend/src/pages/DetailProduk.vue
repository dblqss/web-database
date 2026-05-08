<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const produk = ref(null)

// 🔔 NOTIF STATE
const showNotif = ref(false)
const notifText = ref('')
const notifType = ref('')

// 🔥 MODE EDIT
const isEdit = ref(false)

// 🔥 FORM EDIT
const editNama = ref('')
const editHarga = ref('')
const editStok = ref('')
const editDeskripsi = ref('') // ✅ TAMBAHAN

// FETCH DATA
const fetchData = async () => {
  try {
    const res = await fetch('http://localhost/ecommerce_web/produk.php')

    if (!res.ok) {
      throw new Error('Response tidak valid')
    }

    const data = await res.json()

    if (Array.isArray(data)) {
      const found = data.find(p => p.id == route.params.id) || null
      produk.value = found

      if (found) {
        editNama.value = found.nama_produk
        editHarga.value = found.harga
        editStok.value = found.stok
        editDeskripsi.value = found.deskripsi || '' // ✅ TAMBAHAN
      }
    } else {
      produk.value = null
    }

  } catch (err) {
    console.error('FETCH ERROR:', err)
    produk.value = null
  }
}

onMounted(fetchData)

// 🔔 NOTIF
const triggerNotif = (msg) => {
  notifText.value = msg
  showNotif.value = true

  setTimeout(() => {
    showNotif.value = false
  }, 2500)
}

// 🔥 UPDATE PRODUK
const updateProduk = async () => {
  const formData = new FormData()
  formData.append('id', produk.value.id)
  formData.append('nama_produk', editNama.value)
  formData.append('harga', editHarga.value)
  formData.append('stok', editStok.value)
  formData.append('deskripsi', editDeskripsi.value) // ✅ TAMBAHAN
  formData.append('gambar', produk.value.gambar)

  try {
    const res = await fetch('http://localhost/ecommerce_web/update_produk.php', {
      method: 'POST',
      body: formData
    })

    const result = await res.json()

    if (result.status === 'success') {
      triggerNotif('Produk berhasil diupdate ✏️')
      isEdit.value = false
      fetchData()
    } else {
      alert('Gagal update')
    }
  } catch (err) {
    console.error(err)
    alert('Error')
  }
}
</script>

<template>
  <div class="w-full min-h-screen p-10 bg-[#f6f1e7]">

    <!-- 🔔 NOTIF -->
    <transition name="slide">
      <div 
        v-if="showNotif"
        class="fixed top-5 right-5 px-5 py-3 rounded-xl shadow-lg text-white z-50 bg-[#7da8c3]"
      >
        {{ notifText }}
      </div>
    </transition>

    <!-- CONTENT -->
    <div v-if="produk" class="max-w-5xl mx-auto bg-white border border-[#e7dccf] rounded-2xl p-8 shadow">

      <div class="grid md:grid-cols-2 gap-10">

        <!-- GAMBAR -->
        <div class="aspect-square bg-[#fffaf3] rounded-xl overflow-hidden">
          <img 
            :src="produk.gambar 
              ? 'http://localhost/ecommerce_web/uploads/' + produk.gambar 
              : 'https://via.placeholder.com/300'"
            class="w-full h-full object-cover"
          />
        </div>

        <!-- DETAIL -->
        <div class="flex flex-col justify-between">

          <div>
            <!-- 🔥 TRANSITION VIEW ↔ EDIT -->
            <transition name="fade-slide" mode="out-in">
              <div :key="isEdit">

                <!-- VIEW -->
                <div v-if="!isEdit">
                  <h1 class="text-3xl font-bold text-[#4b3f35]">
                    {{ produk.nama_produk }}
                  </h1>

                  <p class="text-[#7da8c3] text-2xl font-bold mt-3">
                    Rp {{ new Intl.NumberFormat('id-ID').format(produk.harga) }}
                  </p>

                  <p class="mt-3 text-sm">
                    Stok: {{ produk.stok }}
                  </p>

                  <!-- ✅ DESKRIPSI VIEW -->
                  <p class="mt-6 text-gray-600 leading-relaxed">
                    {{ produk.deskripsi || 'Belum ada deskripsi' }}
                  </p>
                </div>

                <!-- EDIT -->
                <div v-else class="space-y-3">
                  <input v-model="editNama" class="border p-2 w-full rounded"/>
                  <input v-model="editHarga" type="number" class="border p-2 w-full rounded"/>
                  <input v-model="editStok" type="number" class="border p-2 w-full rounded"/>

                  <!-- ✅ DESKRIPSI EDIT -->
                  <textarea 
                    v-model="editDeskripsi" 
                    rows="4"
                    class="border p-2 w-full rounded"
                    placeholder="Deskripsi produk..."
                  ></textarea>
                </div>

              </div>
            </transition>
          </div>

          <!-- BUTTON -->
          <div class="mt-8 flex gap-4">

            <template v-if="!isEdit">
              <button 
                @click="isEdit = true"
                class="flex-1 bg-[#7da8c3] text-white py-3 rounded-xl"
              >
                ✏️ Edit Produk
              </button>
            </template>

            <template v-else>
              <button 
                @click="updateProduk"
                class="flex-1 bg-green-500 text-white py-3 rounded-xl"
              >
                💾 Simpan
              </button>

              <button 
                @click="isEdit = false"
                class="flex-1 bg-gray-400 text-white py-3 rounded-xl"
              >
                Batal
              </button>
            </template>

          </div>

        </div>

      </div>

    </div>

    <div v-else class="text-center text-gray-500 mt-10">
      Produk tidak ditemukan / sedang dimuat...
    </div>

  </div>
</template>

<style>
.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s ease;
}
.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: all 0.3s ease;
}
.fade-slide-enter-from {
  opacity: 0;
  transform: translateY(10px);
}
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>