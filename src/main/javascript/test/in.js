/* eslint-disable no-console, require-jsdoc */

// import { View } from "backbone";
// import underscore from "underscore";


//  for (let prop in View) {
//      console.log(prop);
//  }
//  const document = ""
//  const view = new View();
//  for (let prop in view) {
//      console.log(prop);
//  }

@BookCollector()
export default class {

}

function BookCollector (options, test) {
    return (target) => {
        target.finisher = (Class) => class extends Class {

            constructor (...args) {
                super(...args);
                console.log("finisher", this);
            }

            collect () {
                console.log("collect", this);
            }

            log (...args) {
                console.log(this, ...args);
            }

        };
    };
}

function enumerable (target) {
    console.log(target);
    const fn = target.descriptor.value;
    target.descriptor.value = function value (wrestler) {
        fn.call(this, `${wrestler} is a wrestler`);
    };
}


class Person {

    constructor (first, last) {
        this.rename(first, last);
    }

    fullName () {
        return `${this.firstName} ${this.lastName}`;
    }

    rename (first, last) {
        this.firstName = first;
        this.lastName = last;
        return this;
    }

}

@BookCollector()
class Lucas extends Person {

    constructor (options) {
        super({
            tagName: "1234",
            ...options,
        });
        // This.tagName = "tagName";
        this.firstName = "lucas";
    }

    @enumerable
    study (message) {
        console.log(this.firstName, "is studing", message);
    }

    render () {
        console.log(super.render);
        console.log(this.firstName, "is rendering");
    }

}

class Marques extends Lucas {}

const president = new Person("Barak", "Obama");

if (president) {
    console.log("ok", president);
    console.log("ok", president);
} else {
    console.log("nok", president);
}
// President.log("JavaScript Allongé");

console.log(Lucas.__super__); // eslint-disable-line no-underscore-dangle, no-console, max-len
const lucas = new Lucas();
console.log("instanceof", lucas instanceof Lucas, lucas instanceof Person);
lucas.log("lucas log");
console.log(lucas);
lucas.collect();
lucas.study();
lucas.render();


for (const key in lucas) {
    if (Object.prototype.hasOwnProperty.call(lucas, key)) {
        console.log(key, lucas[key]);
    }
}


const marques = new Marques();

marques.log("marques log");
marques.study();
marques.render();
