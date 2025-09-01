<template>
    <div class="dropzone-wrapper" :style="newValue ? `background-image: url(${newValue});` : ''">
        <div class="flex flex-row items-center justify-center space-x-3 p-3">
            <template v-if="!newValue">
                <Icon code="fa6-solid:upload" size="16" />
                <p class="text-sm md:text-lg" v-text="placeholder" />
            </template>
        </div>
        <input ref="input" type="file" @change="(e) => handleFileChange(e)" name="img_logo" class="dropzone" />
    </div>
</template>

<script setup>
import Icon from '@/components/Icon.vue';
import { ref } from 'vue';
const props = defineProps({
    placeholder: {
        type: String,
        default: 'Choose an image file or drag it here.',
    },
    current: null,
});

const emit = defineEmits(['update:modelValue']);

const newValue = ref(props.current);
const notImage = ref('');

function handleFileChange(e) {
    let image = e.target.files[0];
    let reader = new FileReader();

    if (image) {
        notImage.value = image.type.match('image.*');

        // check fileType
        if (!notImage.value) {
            // if fileType not allowed, then clear value and set null
            e.target.value = null;

            // set state "newValue" to null
            newValue.value = null;
            emit('update:modelValue', '');
            // console.log(e.target.value);
        } else {
            newValue.value = reader.readAsDataURL(image) || '';

            reader.onload = (ext) => {
                newValue.value = ext.target.result;
                // console.log(newValue.value);
                // emit('update:modelValue', e.target.value);
                emit('update:modelValue', image);
                // emit('update:modelValue', newValue.value);
            };
        }
    }
}
</script>

<style></style>
