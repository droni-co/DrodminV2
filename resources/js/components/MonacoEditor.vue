<template>
  <div>
    <div ref="editorContainer" style="width: 100%; height: 100%;"></div>
    <textarea class="d-none" :name="name" :value="localValue"></textarea>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import * as monaco from 'monaco-editor';

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
  }
});


const editorContainer = ref();
const localValue = ref(props.value);

onMounted(() => {
  const editorInstance = monaco.editor.create(editorContainer.value, {
    value: props.value,
    language: props.format === 'markdown' ? 'markdown' : 'html',
    theme: 'vs-dark',
    tabSize: 2,
    tabCompletion: 'on',
    wordWrap: 'on',
  });
  editorInstance.onDidChangeModelContent(() => {
    localValue.value = editorInstance.getValue();
  });
});

</script>

<style scoped>
/* Puedes añadir estilos específicos si es necesario */
</style>