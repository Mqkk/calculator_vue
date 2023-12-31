<template>
  <div class="calc-accordion-item">
    <div class="calc-accordion-item__top">
      <AccordionItem :defaultOpened="defaultOpened">
        <template #summary>
          <div class="calc-accordion-item__name">Стоимость: {{ result }}</div>
          <!-- кнопка удаления итема -->
          <button
            class="btn-reset btn btn--mini calc-accordion-item__btn"
            @click="deleteItem"
          >
            <font-awesome-icon :icon="['fa', 'fa-trash']" />
          </button>
        </template>
        <template #icon>
          <font-awesome-icon :icon="['fas', 'chevron-down']" />
        </template>
        <!-- контент итема -->
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
                  :title="itemValueSliderTitle"
                  @inputChanged="handleValueSliderChanged"
                />
              </li>
              <!-- материал стены -->
              <li class="calc-accordion-item__item">
                <calc-item-checkbox
                  :title="itemCheckboxTitle"
                  :checkboxList="this.GET_CROWNS_TWO.materials"
                  @checkboxSelected="handleCheckboxSelected"
                />
              </li>
              <!-- количество проемов -->
              <li class="calc-accordion-item__item">
                <calc-item-counter
                  :title="itemCouterTitle"
                  @quantityUpdate="onQuantityUpdated"
                />
              </li>
            </ul>
          </div>
          <div class="calc-accordion-item__right">
            <!-- высчитывание результат -->
            <calc-item-result-second
              :index="index"
              :inputValue="inputValue"
              :valueSlider="valueSlider"
              :selectedCheckbox="selectedCheckbox"
              :counterValue="counterValue"
              @sendResult="receiveResult"
            />
          </div>
        </div>
      </AccordionItem>
    </div>
    <div class="calc-accordion-item__bottom">
      <calc-item-row-result style="display: none" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import calcItemResultSecond from "../calc-result/calc-item-result-second";
import calcItemRowResult from "../calc-library-items/calc-item-row-result";
import calcItemCheckbox from "../calc-library-items/calc-item-checkbox";
import calcItemValueSlider from "../calc-library-items/calc-item-value-slider";
import calcItemInput from "../calc-library-items/calc-item-input";
import calcItemCounter from "../calc-library-items/calc-item-counter.vue";

export default {
  name: "calc-accordion-item-second",
  components: {
    calcItemResultSecond,
    calcItemRowResult,
    calcItemCheckbox,
    calcItemValueSlider,
    calcItemInput,
    calcItemCounter,
  },
  data() {
    return {
      itemCouterTitle: "Количество проемов",
      itemInputTitle: "Периметр проема (см)",
      itemCheckboxTitle: "Материал стены",
      itemValueSliderTitle: "Толщина стены (см)",
      // переменная для хранения значения счетчика
      counterValue: 0,
      // переменная для хранения периметра проема
      inputValue: 0,
      // переменная для хранения значения valueSlider
      valueSlider: 0,
      // выбранный чекбок для диаметра коронки
      selectedCheckbox: {},
      // результат
      result: 0,
    };
  },
  props: {
    index: {
      type: Number,
    },
    defaultOpened: {
      type: Boolean,
      default: true,
    },
  },
  computed: {
    ...mapGetters(["GET_CROWNS_TWO"]),
  },
  methods: {
    // событие удаление итема
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
    // получение значения счетчика
    onQuantityUpdated(value) {
      this.counterValue = value;
    },
    // получение данных результата
    receiveResult(value) {
      this.result = value;
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
    margin-top: 0;
    width: 30px;
    height: 30px;
  }
}
</style>
