<script setup>
defineProps({
  tasks: {
    type: Array,
  },
});
</script>

<template>
  <ul id="todo-list" class="space-y-4">
    <li
      v-for="task in tasks"
      :key="task.id"
      class="bg-gray-100 px-4 py-2 rounded-lg shadow cursor-move flex items-center justify-between"
      draggable="true"
    >
      <span class="text-gray-700">{{ task.name }}</span>
      <div>
        <button class="text-gray-500 hover:text-gray-700 mr-5">Edit</button>
        <button class="text-red-500 hover:text-red-700">Remove</button>
      </div>
    </li>
  </ul>
</template>
