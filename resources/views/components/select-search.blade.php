@props([
    'name',
    'id' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select an option...',
    'searchPlaceholder' => 'Search...',
    'label' => null,
    'required' => false,
    'disabled' => false,
    'helper' => null,
    'allowClear' => false,
    'multiple' => false,
    'leadingIcon' => null,
])

@php
    $id = $id ?? $name;
    $hasError = $errors->has($name);
    $uniqueId = 'select-' . uniqid();

    // Helper function to check if an option is selected
    $isSelected = function ($value) use ($selected) {
        if (is_array($selected)) {
            return in_array($value, $selected);
        }
        return $selected == $value;
    };

    // Process options to ensure consistent format
    $processedOptions = [];
    foreach ($options as $option) {
        if (isset($option['group'])) {
            $groupOptions = [];
            foreach ($option['options'] as $groupOption) {
                $groupOptions[] = [
                    'value' => $groupOption['value'],
                    'label' => $groupOption['label'],
                    'disabled' => isset($groupOption['disabled']) ? $groupOption['disabled'] : false,
                    'selected' => $isSelected($groupOption['value']),
                    'icon' => isset($groupOption['icon']) ? $groupOption['icon'] : null,
                    'data' => isset($groupOption['data']) ? $groupOption['data'] : null,
                ];
            }
            $processedOptions[] = [
                'type' => 'group',
                'label' => $option['group'],
                'options' => $groupOptions,
            ];
        } else {
            $value = isset($option['value']) ? $option['value'] : $option;
            $groupLabel = isset($option['label']) ? $option['label'] : $option;
            $processedOptions[] = [
                'value' => $value,
                'label' => $groupLabel,
                'disabled' => isset($option['disabled']) ? $option['disabled'] : false,
                'selected' => $isSelected($value),
                'icon' => isset($option['icon']) ? $option['icon'] : null,
                'data' => isset($option['data']) ? $option['data'] : null,
            ];
        }
    }
@endphp

<div {{ $attributes->class(['mb-4']) }}>
    @if ($label)
        <label for="{{ $id }}"
            class="block text-sm font-medium {{ $hasError ? 'text-red-600' : 'text-base-dark' }} mb-1">
            {{ $label }}@if ($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif

    <div class="relative" x-data="selectWithSearch('{{ $uniqueId }}', {{ json_encode($processedOptions) }}, {{ json_encode($selected) }}, {{ $multiple ? 'true' : 'false' }})" x-init="init()" @click.away="open = false"
        @keydown.escape.window="open = false">

        <!-- Hidden input for form submission -->
        @if ($multiple)
            <template x-for="value in selectedValues">
                <input type="hidden" name="{{ $name }}[]" :value="value">
            </template>
        @else
            <input type="hidden" name="{{ $name }}" :value="selectedValue" id="{{ $id }}">
        @endif

        <!-- Select button -->
        <button type="button"
            class="relative w-full shadow-sm bg-white border border-base-light/30 rounded-md px-3 py-2 {{ $leadingIcon ? 'pl-10' : '' }} pr-10 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }} {{ $hasError ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }}"
            @click="toggleDropdown()" @keydown.enter.prevent="toggleDropdown()"
            @keydown.space.prevent="toggleDropdown()" :aria-expanded="open"
            :aria-controls="'{{ $uniqueId }}-listbox'" role="combobox"
            :disabled="{{ $disabled ? 'true' : 'false' }}">

            @if ($leadingIcon)
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    {!! $leadingIcon !!}
                </div>
            @endif

            <!-- For single select -->
            <template x-if="!{{ $multiple ? 'true' : 'false' }}">
                <span class="flex items-center truncate">
                    <template x-if="selectedOption && selectedOption.icon">
                        <span class="flex-shrink-0 mr-2" x-html="selectedOption.icon"></span>
                    </template>
                    <span class="truncate"
                        x-text="selectedOption ? selectedOption.label : '{{ $placeholder }}'"></span>
                </span>
            </template>

            <!-- For multiple select -->
            <template x-if="{{ $multiple ? 'true' : 'false' }}">
                <div class="flex flex-wrap gap-1">
                    <template x-if="selectedOptions.length == 0">
                        <span class="text-gray-400">{{ $placeholder }}</span>
                    </template>
                    <template x-for="option in selectedOptions" :key="option.value">
                        <div class="bg-primary/10 text-primary text-xs rounded px-2 py-1 flex items-center">
                            <template x-if="option.icon">
                                <span class="flex-shrink-0 mr-1" x-html="option.icon"></span>
                            </template>
                            <span x-text="option.label"></span>
                            <button @click.stop="removeSelected(option)" type="button"
                                class="ml-1 hover:text-primary-light">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Dropdown arrow -->
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                x-show="!showClearButton">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </span>

            <!-- Clear button -->
            <template x-if="{{ $allowClear ? 'true' : 'false' }}">
                <span class="absolute inset-y-0 right-0 flex items-center pr-2" x-show="showClearButton">
                    <button type="button" @click.stop="clearSelection()"
                        class="text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="Clear selection">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            </template>
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="relative z-10 mt-1 w-full bg-white shadow-lg max-h-40 rounded-md text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
            :id="'{{ $uniqueId }}-listbox'" role="listbox"
            :aria-multiselectable="{{ $multiple ? 'true' : 'false' }}" style="display: none;">

            <!-- Search box -->
            <div class="sticky top-0 z-10 bg-white p-2">
                <input type="text" x-model="searchQuery" @keydown.escape.prevent="open = false"
                    @keydown.arrow-down.prevent="highlightNext()" @keydown.arrow-up.prevent="highlightPrevious()"
                    @keydown.enter.prevent="selectHighlighted()" @keydown.tab="open = false"
                    class="block w-full px-3 py-1.5 border border-base-light/30 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                    :placeholder="'{{ $searchPlaceholder }}'">
            </div>

            <!-- No results message -->
            <div x-show="filteredOptions.length == 0" class="px-3 py-2 text-sm text-base-light">
                No results found
            </div>

            <!-- Options list -->
            <ul class="py-1">
                <template x-for="(option, index) in filteredOptions" :key="option.value + index">
                    <li class="relative px-2">
                        <template x-if="option.type == 'group'">
                            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide px-3 py-1"
                                x-text="option.label"></div>
                        </template>
                        <template x-if="option.type != 'group'">
                            <button type="button" @click="!option.disabled && selectOption(option)"
                                :class="{
                                    'bg-primary text-white': highlightedIndex == index,
                                    'hover:bg-gray-100': highlightedIndex != index && !option.disabled,
                                    'opacity-50 cursor-not-allowed': option.disabled,
                                    'bg-primary/10 text-primary': isOptionSelected(option) && highlightedIndex != index
                                }"
                                :disabled="option.disabled"
                                class="w-full flex items-center px-3 py-2 text-sm rounded-md cursor-pointer"
                                role="option" :aria-selected="isOptionSelected(option)">
                                <template x-if="option.icon">
                                    <span class="flex-shrink-0 mr-2" x-html="option.icon"></span>
                                </template>
                                <span x-text="option.label" class="truncate"></span>
                                <template x-if="isOptionSelected(option) && {{ $multiple ? 'true' : 'false' }}">
                                    <svg class="h-4 w-4 ml-auto text-primary" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </button>
                        </template>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    @if ($helper && !$hasError)
        <p class="mt-1 text-sm text-base-light">{{ $helper }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
    <script>
        function selectWithSearch(id, options, initialValue, isMultiple = false) {
            return {
                open: false,
                options: options,
                selectedValue: isMultiple ? null : (initialValue || null),
                selectedValues: isMultiple ? (Array.isArray(initialValue) ? initialValue : (initialValue ? [initialValue] :
                    [])) : [],
                selectedOption: null,
                searchQuery: '',
                highlightedIndex: 0,

                get showClearButton() {
                    return isMultiple ? this.selectedValues.length > 0 : this.selectedValue != null;
                },

                get selectedOptions() {
                    if (!isMultiple) return [];

                    return this.selectedValues.map(value => {
                        return this.findOptionByValue(value);
                    }).filter(option => option != null);
                },

                get filteredOptions() {
                    if (!this.searchQuery) return this.getFlattenedOptions(this.options);

                    const query = this.searchQuery.toLowerCase();

                    // Filter options based on search query
                    const filterOption = (option) => {
                        if (option.type == 'group') {
                            const filteredGroupOptions = option.options.filter(o =>
                                o.label.toLowerCase().includes(query)
                            );

                            if (filteredGroupOptions.length > 0) {
                                return {
                                    ...option,
                                    options: filteredGroupOptions
                                };
                            }
                            return null;
                        }

                        return option.label.toLowerCase().includes(query) ? option : null;
                    };

                    const filteredOptions = [];
                    for (const option of this.options) {
                        const filtered = filterOption(option);
                        if (filtered) {
                            filteredOptions.push(filtered);
                        }
                    }

                    return this.getFlattenedOptions(filteredOptions);
                },

                getFlattenedOptions(options) {
                    // Flatten groups for easier navigation
                    let flattened = [];
                    for (const option of options) {
                        if (option.type == 'group') {
                            flattened.push({
                                ...option
                            });
                            for (const groupOption of option.options) {
                                flattened.push(groupOption);
                            }
                        } else {
                            flattened.push(option);
                        }
                    }
                    return flattened;
                },

                init() {
                    this.findAndSetSelectedOption();
                },

                findAndSetSelectedOption() {
                    if (!isMultiple && this.selectedValue != null) {
                        this.selectedOption = this.findOptionByValue(this.selectedValue);
                    }
                },

                findOptionByValue(value) {
                    const findInOptions = (options) => {
                        for (const option of options) {
                            if (option.type == 'group' && option.options) {
                                const found = findInOptions(option.options);
                                if (found) return found;
                            } else if (String(option.value) == String(value)) {
                                return option;
                            }
                        }
                        return null;
                    };

                    return findInOptions(this.options);
                },

                toggleDropdown() {
                    if (this.open) {
                        this.open = false;
                        return;
                    }

                    this.open = true;
                    this.searchQuery = '';
                    this.highlightedIndex = 0;

                    // Focus the search input when opening
                    this.$nextTick(() => {
                        const searchInput = this.$el.querySelector('input[type="text"]');
                        if (searchInput) {
                            searchInput.focus();
                        }
                    });
                },

                selectOption(option) {
                    if (option.disabled) return;

                    if (isMultiple) {
                        const index = this.selectedValues.indexOf(option.value);
                        if (index == -1) {
                            this.selectedValues.push(option.value);
                        } else {
                            this.selectedValues.splice(index, 1);
                        }
                    } else {
                        this.selectedOption = option;
                        this.selectedValue = option.value;
                        this.open = false;
                    }

                    // Trigger change event
                    this.$nextTick(() => {
                        const input = isMultiple ?
                            this.$el.querySelector(`input[name="${id}[]"]`) :
                            this.$el.querySelector(`input[name="${id}"]`);
                        if (input) {
                            input.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        }
                    });
                },

                isOptionSelected(option) {
                    if (isMultiple) {
                        return this.selectedValues.includes(option.value);
                    } else {
                        return this.selectedValue == option.value;
                    }
                },

                removeSelected(option) {
                    if (isMultiple) {
                        const index = this.selectedValues.indexOf(option.value);
                        if (index != -1) {
                            this.selectedValues.splice(index, 1);

                            // Trigger change event
                            this.$nextTick(() => {
                                const input = this.$el.querySelector(`input[name="${id}[]"]`);
                                if (input) {
                                    input.dispatchEvent(new Event('change', {
                                        bubbles: true
                                    }));
                                }
                            });
                        }
                    }
                },

                clearSelection() {
                    if (isMultiple) {
                        this.selectedValues = [];
                    } else {
                        this.selectedOption = null;
                        this.selectedValue = null;
                    }

                    // Trigger change event
                    this.$nextTick(() => {
                        const input = isMultiple ?
                            this.$el.querySelector(`input[name="${id}[]"]`) :
                            this.$el.querySelector(`input[name="${id}"]`);
                        if (input) {
                            input.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        }
                    });
                },

                highlightNext() {
                    let nextIndex = this.highlightedIndex;
                    do {
                        nextIndex++;
                        if (nextIndex >= this.filteredOptions.length) {
                            nextIndex = 0;
                        }
                    } while (
                        nextIndex != this.highlightedIndex &&
                        (this.filteredOptions[nextIndex]?.type == 'group' ||
                            this.filteredOptions[nextIndex]?.disabled)
                    );

                    if (nextIndex != this.highlightedIndex && this.filteredOptions[nextIndex]) {
                        this.highlightedIndex = nextIndex;
                        this.scrollToHighlighted();
                    }
                },

                highlightPrevious() {
                    let prevIndex = this.highlightedIndex;
                    do {
                        prevIndex--;
                        if (prevIndex < 0) {
                            prevIndex = this.filteredOptions.length - 1;
                        }
                    } while (
                        prevIndex != this.highlightedIndex &&
                        (this.filteredOptions[prevIndex]?.type == 'group' ||
                            this.filteredOptions[prevIndex]?.disabled)
                    );

                    if (prevIndex != this.highlightedIndex && this.filteredOptions[prevIndex]) {
                        this.highlightedIndex = prevIndex;
                        this.scrollToHighlighted();
                    }
                },

                selectHighlighted() {
                    if (this.filteredOptions[this.highlightedIndex] &&
                        this.filteredOptions[this.highlightedIndex].type != 'group' &&
                        !this.filteredOptions[this.highlightedIndex].disabled) {
                        this.selectOption(this.filteredOptions[this.highlightedIndex]);
                    }
                },

                scrollToHighlighted() {
                    this.$nextTick(() => {
                        const highlighted = this.$el.querySelector(
                            `[role="option"][aria-selected="${this.highlightedIndex}"]`);
                        const container = this.$el.querySelector(`[role="listbox"]`);

                        if (highlighted && container) {
                            if (highlighted.offsetTop < container.scrollTop) {
                                container.scrollTop = highlighted.offsetTop;
                            } else if (highlighted.offsetTop + highlighted.offsetHeight > container.scrollTop +
                                container.offsetHeight) {
                                container.scrollTop = highlighted.offsetTop + highlighted.offsetHeight - container
                                    .offsetHeight;
                            }
                        }
                    });
                }
            };
        }
    </script>
@endpush
