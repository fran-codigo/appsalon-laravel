import { generateClasses } from "@formkit/themes";

const config = {
    config: {
        classes: generateClasses({
            global: {
                wrapper: "space-y-2 mb-3",
                message:
                    "border border-red-50 border-l-4 border-l-red-600 text-center text-sm font-bold uppercase py-2 my-5 text-red-600",
                label: "block mb-1 font-bold text-lg",
                input: "w-full p-3 border border-gray-300 rounded-lg text-gray-700 placeholder-gray-400",
            },
            submit: {
              input: `$reset bg-blue-500 hover:bg-blue-600 rounded-lg text-white font-bold w-full p-3 mt-3`
            },
        }),
    },
};

export default config;
