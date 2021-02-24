import { StoreType } from "js/store";
import * as Api from "js/api";

declare module 'vue/types/vue' {
    interface Vue {
        $store: StoreType;
        $api: typeof Api;
    }

    interface VueConstructor {
        $store: StoreType;
        $api: typeof Api;
    }
}