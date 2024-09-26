<template>
  <div>
    <div class="input-group">
      <input type="text" class="form-control" :name="props.name" v-model="localValue" placeholder="Imagen">
      <a v-if="localValue.length > 0" :href="localValue" class="btn btn-outline-secondary" target="_blank">
        <i class="mdi mdi-open-in-new"></i>
      </a>
      <button class="btn btn-outline-secondary" type="button" @click="exploreFiles">
        <i class="mdi mdi-cloud-upload-outline"></i>
      </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" ref="attachmentList">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header d-flex">
            <h1 class="modal-title fs-5" id="attachmentListLabel">Multimedia</h1>
            <input
              type="search"
              class="form-control rounded-pill mx-3"
              placeholder="Buscar"
              v-model="search"
              v-on:keydown.enter.prevent="loadFiles()">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
              <div class="col px-1">
                <label class="card cardSelector" for="file">
                  <input type="file" id="file" class="d-none" @change="uploadFile">
                  <div class="fs-1 text-center bg-secondary py-4">
                    <i class="mdi mdi-cloud-upload-outline"></i>
                  </div>
                  <div class="card-body p-1 text-center">
                    <h6 class="m-0">Agregar nuevo</h6>
                  </div>
                </label>
              </div>
              <div class="col px-1" v-for="attachment in attachments.data" :key="attachment.id">
                <div
                  class="card cardSelector mb-2"
                  :class="{ active: localValue === attachment.url }"
                  @click="selectAttachment(attachment)">
                  <img v-if="attachment.mime_type.includes('image')" :src="attachment.url" class="card-img-top" :alt="attachment.name">
                  <img v-else src="/img/docFile.png" class="card-img-top" :alt="attachment.name">
                  <div class="card-body p-1 text-center">
                    <h6 class="m-0">{{ attachment.name }}</h6>
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

<script setup lang="ts">
import { defineProps, ref, useTemplateRef } from 'vue';
import { Modal } from 'bootstrap'
import axios from 'axios';
const props = defineProps({
  value: {
    type: String,
    required: true
  },
  format: {
    type: String,
    default: 'markdown'
  },
  name: {
    type: String,
    default: 'editor'
  },
  siteId: {
    type: String,
    required: true
  }
});

const refModal = useTemplateRef('attachmentList')
const localValue = ref(props.value);
const page = ref(1);
const search = ref('');
const attachments = ref([]);


const exploreFiles = () => {
  const modal = new Modal(refModal.value, {
    keyboard: false,
    backdrop: 'static'
  });
  modal.show();
  loadFiles();
};

const loadFiles = () => {
  axios.get(`/sites/${props.siteId}/attachments?page=${page.value}&search=${search.value}`)
    .then(response => {
      attachments.value = response.data;
    })
    .catch(error => {
      console.error(error);
    });
};

const selectAttachment = (attachment) => {
  localValue.value = attachment.url;
  const modal = Modal.getInstance(refModal.value);
  modal.hide();
};

const uploadFile = (event) => {
  const formData = new FormData();
  formData.append('file', event.target.files[0]);
  axios.post(`/sites/${props.siteId}/attachments`, formData)
    .then(response => {
      localValue.value = response.data.url;
      loadFiles();
    })
    .catch(error => {
      console.error(error);
    });
};

</script>

<style scoped>
.cardSelector {
  cursor: pointer;
  transition: background-color 0.3s;
}
.cardSelector:hover {
  background-color: #b3b3b3e5;
  box-shadow: 0 0 10px 0 #1361afa2;
}
.cardSelector.active {
  background-color: #b3b3b3e5;
  box-shadow: 0 0 5px 5px #1361afa2;
}
</style>