import { mount } from '@vue/test-utils';
import ExampleComponent from './../../resources/assets/js/components/ExampleComponent.vue';
import expect from 'expect';

describe('Example components', () => {

    let wrapper;

    beforeEach(() => {
        wrapper = mount(ExampleComponent);
    });
    
    it('at start count is zero', () => {
        expect(wrapper.vm.count).toBe(0);
    });

    it('contains the correct message on load', () => {
        expect(wrapper.find('.card-header').text()).toBe('Example Component');
    });

});
