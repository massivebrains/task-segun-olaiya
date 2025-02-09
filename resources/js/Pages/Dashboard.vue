<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref, watch } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import draggable from "vuedraggable";

const props = defineProps({
  tasks: {
    type: Array,
  },
  projects: {
    type: Array,
  },
});

const form = useForm({
  id: "",
  name: "",
  priority: "0",
  project_id: "",
  new_project_name: "",
});

const showFormModal = ref(false);

const closeModal = () => {
  showFormModal.value = false;
  form.clearErrors();
  form.reset();
};

const taskList = ref([...props.tasks]);
watch(taskList, async (tasks) => {
  const newTaskOrder = tasks.map(function (task, index) {
    return {
      id: task.id,
      priority: index,
    };
  });

  useForm({ tasks: newTaskOrder }).patch(route("tasks.update.priorities"));
});

const editTask = (selectedTask) => {
  form.id = selectedTask.id.toString();
  form.project_id = selectedTask.project_id;
  form.name = selectedTask.name;
  form.priority = selectedTask.priority;
  showFormModal.value = true;
};

const deleteTask = (selectedTask) => {
  form.id = selectedTask.id.toString();

  form.delete(route("task.destroy"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <Head title="Tasks" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        <PrimaryButton @click="showFormModal = true">New Task</PrimaryButton>
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-8">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900">All Tasks</h2>
              <p class="mt-1 text-sm text-gray-600">You can rearrange tasks</p>
            </header>

            <ul id="todo-list" class="space-y-4 mt-4">
              <draggable v-model="taskList" itemKey="id">
                <template #item="{ element }">
                  <li
                    :key="element.id"
                    class="bg-gray-100 px-4 py-2 rounded-lg shadow cursor-move flex items-center justify-between mb-4"
                    draggable="true"
                  >
                    <span class="text-gray-700">{{ element.name }}</span>
                    <div>
                      <button
                        class="text-gray-500 hover:text-gray-700 mr-5"
                        @click="() => editTask(element)"
                      >
                        Edit
                      </button>
                      <button
                        class="text-red-500 hover:text-red-700"
                        @click="() => deleteTask(element)"
                      >
                        Remove
                      </button>
                    </div>
                  </li>
                </template>
              </draggable>
            </ul>
          </section>
        </div>
      </div>

      <Modal :show="showFormModal" @close="closeModal">
        <section class="p-8">
          <header>
            <h2 class="text-lg font-medium text-gray-900">
              {{ form.id ? "Edit Task" : "Create Task" }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">Task form</p>
          </header>

          <form @submit.prevent="form.post(route('task.save'))" class="mt-6 space-y-6">
            <div>
              <InputLabel for="name" value="Name" />
              <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
              />
              <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="flex justify-between gap-4">
              <div :class="form.project_id ? 'w-full' : 'w-1/2'">
                <InputLabel for="name" value="Project" />
                <select
                  class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full"
                  v-model="form.project_id"
                >
                  <option value="">-- New Project --</option>
                  <option
                    v-for="project in projects"
                    :key="project.id"
                    :value="project.id"
                  >
                    {{ project.name }}
                  </option>
                </select>
                <InputError class="mt-2" :message="form.errors.project_id" />
              </div>

              <div class="w-1/2" v-if="!form.project_id">
                <InputLabel for="name" value="New Project Name" />
                <TextInput
                  id="new_project_name"
                  type="text"
                  class="mt-1 block w-full"
                  placeholder="Enter new Project Name"
                  v-model="form.new_project_name"
                />
                <InputError class="mt-2" :message="form.errors.new_project_name" />
              </div>
            </div>

            <div>
              <InputLabel for="priority" value="Priority" />
              <TextInput
                id="priority"
                type="text"
                class="mt-1 block w-full"
                v-model="form.priority"
              />
            </div>

            <div class="flex items-center gap-4">
              <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
              <SecondaryButton @click="showFormModal = false">Close</SecondaryButton>

              <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
              >
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                  Task Created successfully
                </p>
              </Transition>
            </div>
          </form>
        </section>
      </Modal>
    </div>
  </AuthenticatedLayout>
</template>
