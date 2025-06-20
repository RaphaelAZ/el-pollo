<script setup lang="ts">
import { cityRules, mainAddressRules, postalCodeRules } from '@/utils/rulesUtils.ts'
import { useTemplateRef } from 'vue'
import { VForm } from 'vuetify/components'
import { useSnackbarStore } from '@/stores/snackBarStore.ts'
import { type snackBarParams, SnackBarStatus } from '@/models/snackBarParams.ts'
import type { OrderPayValues } from '@/models/order.ts'

const emit = defineEmits<{
  (e: 'order-paid', data: OrderPayValues): void
}>()

const snackbarManager = useSnackbarStore()

const mainAddressModel = defineModel<string>('mainAddress')
const postalCodeModel = defineModel<string>('postalCode')
const cityModel = defineModel<string>('city')

const parentFormAnchor = useTemplateRef<InstanceType<typeof VForm>>('form-anchor')

const handleFormSubmit = async (): Promise<void> => {
  const mainForm = parentFormAnchor.value

  if ( mainForm ) {
    const { valid } = await mainForm.validate()

    if( valid ) {

      const formData = {
        address: mainAddressModel.value,
        postalCode: Number.parseInt( postalCodeModel.value as string ),
        city: cityModel.value
      } as OrderPayValues

      emit('order-paid', formData)
    }

  } else {
    snackbarManager.showSnackbar({
      message: 'Erreur inconnue lors de la soumission du formulaire',
      timer: 15000,
      status: SnackBarStatus.WARNING,
    } as snackBarParams)
  }
}
</script>

<template>
  <v-form
    fast-fail
    @submit.prevent="handleFormSubmit"
    ref="form-anchor"
  >
    <v-row>
      <v-col cols="6">
        <v-textarea v-model="mainAddressModel" :rules="mainAddressRules" label="Adresse" />
      </v-col>

      <v-col cols="6" class="d-flex flex-column align-content-space-between">
        <v-text-field v-model="postalCodeModel" :rules="postalCodeRules" label="Code postal" />

        <v-text-field v-model="cityModel" :rules="cityRules" label="Ville" />
      </v-col>
    </v-row>

    <div class="mt-5 d-flex justify-center">
      <v-btn
        color="info"
        size="large"
        type="submit"
      >
        <Icon icon="emojione:fork-and-knife-with-plate" />
        Confirmer
      </v-btn>
    </div>
  </v-form>
</template>

<style scoped></style>
