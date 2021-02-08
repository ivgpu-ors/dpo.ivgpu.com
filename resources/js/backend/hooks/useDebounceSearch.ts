import { ref } from "vue";

export default function useDebounceSearch(callback: Function, timeoutCount = 800) {
  let timeoutRef: number | null = null;
  const displayValue = ref("");

  const debounceListener = (value: string) => {
    if (timeoutRef !== null) {
      clearTimeout(timeoutRef);
    }

    displayValue.value = value;
    // @ts-ignore
    timeoutRef = setTimeout(() => {
      callback(value);
    }, timeoutCount);
  };

  return { displayValue, debounceListener };
}
