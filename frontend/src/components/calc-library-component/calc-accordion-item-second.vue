<template>
  <div class="calc-accordion-item">
    <div class="calc-accordion-item__top">
      <AccordionItem>
        <template #summary
          ><div class="calc-accordion-item__name">Стоимость: 0</div>
        </template>
        <template #icon>
          <font-awesome-icon :icon="['fas', 'chevron-down']" />
        </template>
        <!-- accordion-content -->
        <div class="calc-accordion-item__content">
          <div class="calc-accordion-item__left">
            <ul class="list-reset calc-accordion-item__list">
              <!-- периметр проема -->
              <li class="calc-accordion-item__item">
                <calc-item-input
                  :title="itemInputTitle"
                  @inputChanged="handleInputChanged"
                />
              </li>
              <!-- толщина стены -->
              <li class="calc-accordion-item__item">
                <calc-item-value-slider
                  @inputChanged="handleValueSliderChanged"
                />
              </li>
              <!-- материал стены -->
              <li class="calc-accordion-item__item">
                <calc-item-checkbox
                  :title="itemCheckboxTitle"
                  :checkboxList="checkboxList"
                  @checkboxSelected="handleCheckboxSelected"
                />
              </li>
            </ul>
          </div>
          <!-- result -->
          <div class="calc-accordion-item__right">
            <calc-item-result-second
              :inputValue="inputValue"
              :valueSlider="valueSlider"
              :selectedCheckbox="selectedCheckbox"
            />
          </div>
        </div>
      </AccordionItem>
      <!-- btn-delete -->
      <button
        class="btn-reset btn btn--mini calc-accordion-item__btn"
        @click="deleteItem"
      >
        <font-awesome-icon :icon="['fa', 'fa-trash']" />
      </button>
    </div>
    <div class="calc-accordion-item__bottom">
      <calc-item-row-result style="display: none" />
    </div>
  </div>
</template>

<script>
import calcItemResultSecond from "../calc-library-items/calc-item-result-second.vue";
import calcItemRowResult from "../calc-library-items/calc-item-row-result.vue";
import calcItemCheckbox from "../calc-library-items/calc-item-checkbox.vue";
import calcItemValueSlider from "../calc-library-items/calc-item-value-slider.vue";
import calcItemInput from "../calc-library-items/calc-item-input.vue";

export default {
  name: "calc-accordion-item-second",
  components: {
    calcItemResultSecond,
    calcItemRowResult,
    calcItemCheckbox,
    calcItemValueSlider,
    calcItemInput,
  },
  data() {
    return {
      itemInputTitle: "Периметр проема",
      itemCheckboxTitle: "Материал стены",
      // переменная для хранения периметра проема
      inputValue: 0,
      // переменная для хранения значения valueSlider
      valueSlider: 0,
      // список для чекбоксов
      checkboxList: ["Кирпич", "Бетон", "Глина"],
      // выбранный чекбок для диаметра коронки
      selectedCheckbox: null,
    };
  },
  methods: {
    deleteItem() {
      this.$emit("deleteItem", this.index);
    },
    // получение значения инпута от ребенка
    handleInputChanged(value) {
      this.inputValue = value;
    },
    // обработчик события, вызываемый при изменении значения valueSlider
    handleValueSliderChanged(value) {
      this.valueSlider = value;
    },
    // получение выбранного чекбокса материала стены
    handleCheckboxSelected(item) {
      this.selectedCheckbox = item;
    },
  },
};
</script>

<style lang="scss" scoped>
.calc-accordion-item {
  display: flex;
  flex-direction: column;
  gap: 2px;

  &__top {
    display: flex;
    align-items: flex-start;
    gap: 10px;

    @include mobile {
      gap: 5px;
    }
  }

  &__name {
    display: flex;
    align-items: center;

    span {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-left: 5px;
      border-radius: $border-radius;
      padding: 4px 10px;
      min-width: 25px;
      font-weight: 400;
      font-size: 12px;
      line-height: 16px;
      color: $light-color;
      background-color: $black-color;

      span {
        margin-left: 5px;
        padding: 0;
        min-width: 0;
        font-weight: 500;
      }

      @include tablet {
        min-width: 20px;
      }

      @include mobile {
        margin-left: 0;
        font-size: 12px;
      }
    }

    @include mobile {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  &__content {
    display: grid;
    column-gap: 20px;
    grid-column: 13 span;
    grid-template-columns: repeat(12, 1fr);
  }

  &__left {
    grid-column: 7 span;

    @include tablet {
      grid-column: 12 span;
    }
  }

  &__right {
    grid-column: 5 span;

    @include tablet {
      grid-column: 12 span;
    }
  }

  &__btn {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
    width: 40px;
    height: 40px;
  }
}
</style>