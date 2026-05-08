<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const produk = ref([])
const loading = ref(true)
const error = ref(null)

// 🔥 BASE URL API
const BASE_URL = 'https://myshop42.infinityfreeapp.com'

// 🔥 FORM STATE
const nama = ref('')
const harga = ref('')
const stokInput = ref('')
const gambar = ref('')

// 🔥 FETCH DATA
const fetchData = async () => {
  try {
    const res = await fetch(`${BASE_URL}/produk.php`)

    if (!res.ok) {
      throw new Error('Response tidak valid')
    }

    const data = await res.json()

    // 🔧 pastikan selalu array
    produk.value = Array.isArray(data) ? data : []
  } catch (err) {
    error.value = 'Gagal mengambil data produk'
    console.error('FETCH ERROR:', err)
  } finally {
    loading.value = false
  }
}

onMounted(fetchData)

// 🔥 TAMBAH PRODUK
const tambahProduk = async () => {
  // 🔧 validasi lebih aman
  if (!nama.value.trim() || !harga.value || !stokInput.value) {
    alert('Semua field wajib diisi!')
    return
  }

  const formData = new FormData()
  formData.append('nama_produk', nama.value)
  formData.append('harga', harga.value)
  formData.append('stok', stokInput.value)
  formData.append('gambar', gambar.value || '')

  try {
    const res = await fetch(
  `${BASE_URL}/tambah_produk.php`, {
  method: 'POST',
  body: formData
})

    if (!res.ok) {
      throw new Error('Gagal request ke server')
    }

    const result = await res.json()

    if (result.status === 'success') {
      alert('Produk berhasil ditambahkan!')
      await fetchData()

      // 🔧 reset lebih aman
      nama.value = ''
      harga.value = ''
      stokInput.value = ''
      gambar.value = ''
    } else {
      alert('Gagal: ' + (result.message || 'Unknown error'))
    }
  } catch (err) {
    alert('Terjadi error')
    console.error('INSERT ERROR:', err)
  }
}

// 🔥 HAPUS PRODUK
const hapusProduk = async (id) => {
  if (!id) return
  if (!confirm('Yakin mau hapus produk ini?')) return

  const formData = new FormData()
  formData.append('id', id)

  try {
    const res = await fetch(
  `${BASE_URL}/hapus_produk.php`, {
  method: 'POST',
  body: formData
})

    if (!res.ok) {
      throw new Error('Gagal request ke server')
    }

    const result = await res.json()

    if (result.status === 'success') {
      alert('Produk berhasil dihapus!')
      await fetchData()
    } else {
      alert('Gagal: ' + (result.message || 'Unknown error'))
    }
  } catch (err) {
    alert('Terjadi error')
    console.error('DELETE ERROR:', err)
  }
}

// 🔥 DETAIL
const goDetail = (id) => {
  if (!id) return
  router.push({ name: 'detail-produk', params: { id } })
}
</script>

<template>
  <div class="w-full min-h-screen p-10 bg-[#f6f1e7]">

    <h2 class="text-2xl font-bold text-[#4b3f35] mb-6">
      📦 Stok Produk
    </h2>

    <!-- 🔥 FORM TAMBAH PRODUK -->
    <div class="mb-8 bg-white p-6 rounded-xl shadow">

      <h3 class="text-lg font-bold mb-4 text-[#4b3f35]">
        ➕ Tambah Produk
      </h3>

      <div class="grid md:grid-cols-4 gap-4">

        <input 
          v-model="nama" 
          placeholder="Nama Produk" 
          class="border p-2 rounded"
        />

        <input 
          v-model="harga" 
          placeholder="Harga" 
          type="number"
          class="border p-2 rounded"
        />

        <input 
          v-model="stokInput" 
          placeholder="Stok" 
          type="number"
          class="border p-2 rounded"
        />

        <input 
          v-model="gambar" 
          placeholder="Gambar (opsional)" 
          class="border p-2 rounded"
        />

      </div>

      <button 
        @click="tambahProduk"
        class="mt-4 bg-[#7da8c3] text-white px-6 py-2 rounded-lg hover:opacity-90"
      >
        Simpan
      </button>

    </div>

    <!-- LOADING -->
    <div v-if="loading" class="text-center text-gray-500">
      Loading produk...
    </div>

    <!-- ERROR -->
    <div v-else-if="error" class="text-center text-red-500">
      {{ error }}
    </div>

    <!-- DATA KOSONG -->
    <div v-else-if="produk.length === 0" class="text-center text-gray-500">
      Belum ada produk
    </div>

    <!-- LIST PRODUK -->
    <div v-else class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

      <div 
        v-for="p in produk"
        :key="p.id"
        @click="goDetail(p.id)"
        class="cursor-pointer bg-white border border-[#e7dccf] rounded-2xl p-4 
               hover:shadow-lg hover:-translate-y-1 transition duration-200"
      >

        <!-- GAMBAR -->
        <div class="aspect-square bg-[#fffaf3] rounded-xl overflow-hidden mb-3">
          <img 
            :src="p.gambar 
              ? BASE_URL + '/uploads/' + p.gambar 
              : 'https://via.placeholder.com/300'"
            class="w-full h-full object-cover hover:scale-105 transition"
          />
        </div>

        <!-- NAMA -->
        <h3 class="font-semibold text-[#4b3f35] line-clamp-1">
          {{ p.nama_produk || 'Tanpa Nama' }}
        </h3>

        <!-- HARGA -->
        <p class="text-[#7da8c3] font-bold mt-1">
          Rp {{ new Intl.NumberFormat('id-ID').format(p.harga || 0) }}
        </p>

        <!-- 🔥 BUTTON HAPUS -->
        <button 
          @click.stop="hapusProduk(p.id)"
          class="mt-3 w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition text-sm"
        >
          🗑 Hapus
        </button>

      </div>

    </div>

  </div>
</template>