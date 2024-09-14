<template>
  <div>
    <h1>Monaco Editor en Vite</h1>
    <div ref="editorContainer" style="width: 100%; height: 500px;"></div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import * as monaco from 'monaco-editor';

const editorContainer = ref();

onMounted(() => {
  const editorInstance = monaco.editor.create(editorContainer.value, {
    value: `function helloWorld() {\n  console.log("Hello, world!");\n}`,
    language: 'markdown',
    theme: 'vs-dark',
  });
  editorInstance.onDidChangeModelContent(() => {
    console.log(editorInstance.getValue());
  });
});

</script>

<style scoped>
/* Puedes añadir estilos específicos si es necesario */
</style>