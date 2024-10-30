<template>
  <div class="addAttr">
    <datalist id="attrNames">
      <option v-for="elis in datalist" :value="elis"></option>
    </datalist>

    <div class="card shadow p-2">
      <p class="m-0 mb-1">Agregar nuevo atributo.</p>
      <input list="attrNames"
          type="text"
          class="form-control form-control-sm mb-2"
          id="attrName"
          placeholder="Atributo"
          v-model="newAttr.name"
          v-on:keydown.enter.prevent='validateNewAttr'
          v-on:input="validateNewAttr">
      <input
        type="text"
        class="form-control form-control-sm mb-2"
        id="attrValue"
        placeholder="Valor"
        v-model="newAttr.value"
        v-on:keydown.enter.prevent='addAttr'>
      <button type="button" class="btn btn-sm btn-outline-primary" @click="addAttr">
        <i class="mdi mdi-plus"></i>
        Agregar
      </button>
    </div>
    <hr>
    <div v-for="localAttr in localAttrs" :key="localAttr.id" class="form-floating mb-3 mt-2">
      <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Close" @click="removeAttr(localAttr)"></button>
      <input type="text" class="form-control" id="attrValue" placeholder="valor" required v-model="localAttr.value">
      <label for="attrValue">{{ localAttr.name }}</label>
    </div>
  </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import { defineProps, PropType, ref } from 'vue';
interface Attr {
  id?: number
  site_id?: string
  attributable_type?: string
  attributable_id?: number
  name: string
  type?: string
  value: string
  created_at?: string
  updated_at?: string
}
const props = defineProps({
  attrs: {
    type: Array as PropType<Attr[]>,
    required: true,
  },
  attributable: {
    type: Object,
    required: true,
  },
  attributableType: {
    type: String,
    required: true,
  },
  site: {
    type: Object,
    required: true,
  },
});


const localAttrs = ref<Attr[]>(props.attrs);
const newAttr = ref<Attr>({ name: '', value: '' });

const datalist = ref<string[]>([]);

const getDataList = () => {
  axios.get(`/sites/${props.site.id}/attrs?attributableType=${props.attributableType}`)
    .then((response) => {
      datalist.value = response.data;
    })
    .catch((error) => {
      console.log(error);
    });
};
getDataList();

const validateNewAttr = () => {
  // newAttr.value.name to slug
  newAttr.value.name = newAttr.value.name.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase();
  newAttr.value.value = newAttr.value.value.trim();
  return newAttr.value.name.trim() !== '' && newAttr.value.value.trim() !== '';
};

const addAttr = () => {
  if(validateNewAttr()){
    axios.post(`/sites/${props.site.id}/attrs`, {
      attributable_type: props.attributableType,
      attributable_id: props.attributable.id,
      name: newAttr.value.name,
      value: newAttr.value.value,
    })
      .then((response) => {
        localAttrs.value.push(response.data);
        newAttr.value = { name: '', value: '' };
      })
      .catch((error) => {
        console.log(error);
      });
  }
};

const removeAttr = (attr: Attr) => {
  axios.delete(`/sites/${props.site.id}/attrs/${attr.id}`)
    .then(() => {
      const index = localAttrs.value.indexOf(attr);
      localAttrs.value.splice(index, 1);
    })
    .catch((error) => {
      console.log(error);
    });  
};
</script>
