<template>
  <div class="addProp">
    <datalist id="propNames">
      <option v-for="elis in datalist" :value="elis"></option>
    </datalist>

    <div class="form-floating mb-3 mt-2">
      <input
        list="propNames"
        type="text"
        class="form-control"
        id="propName"
        placeholder="Título del post"
        v-model="newProp.name"
        v-on:keydown.enter.prevent='validateNewProp'
        v-on:input="validateNewProp">
      <label for="propName">Propiedad</label>
    </div>
    <div class="form-floating mb-3 mt-2">
      <input
        type="text"
        class="form-control"
        id="propValue"
        placeholder="valor"
        v-model="newProp.value"
        v-on:keydown.enter.prevent='addProp'>
      <label for="propValue">Valor</label>
    </div>
    <hr>
    <div v-for="localProp in localProps" :key="localProp" class="form-floating mb-3 mt-2">
      <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Close" @click="removeProp(localProp)"></button>
      <input type="text" class="form-control" id="propValue" placeholder="valor" required v-model="localProp.value">
      <label for="propValue">{{ localProp.name }}</label>
    </div>
    <input type="hidden" :name="props.name" :value="JSON.stringify(localProps)">
  </div>
</template>

<script setup lang="ts">
import { defineProps, ref } from 'vue';
interface Prop {
  name: string;
  value: string;
}
const props = defineProps({
  props: {
    type: Array as PropType<Prop[]>,
    required: true,
  },
  name: {
    type: String,
    default: 'props',
  },
  datalist: {
    type: Array as PropType<string[]>,
    default: () => [],
  }
});

const localProps = ref<Prop[]>(props.props);
const newProp = ref<Prop>({ name: '', value: '' });

const validateNewProp = () => {
  // newProp.value.name to slug
  newProp.value.name = newProp.value.name.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase();
  newProp.value.value = newProp.value.value.trim();
  return newProp.value.name.trim() !== '' && newProp.value.value.trim() !== '';
};

const addProp = () => {
  if(validateNewProp()){
    localProps.value.push({ ...newProp.value });
    newProp.value = { name: '', value: '' };
  }
};

const removeProp = (prop: Prop) => {
  const index = localProps.value.indexOf(prop);
  localProps.value.splice(index, 1);
};
</script>
