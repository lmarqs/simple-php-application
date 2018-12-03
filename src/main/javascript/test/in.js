/* eslint-disable max-classes-per-file, no-console, require-jsdoc */

import Backbone from "backbone";
// import underscore from "underscore";

//  for (let prop in View) {
//      console.log(prop);
//  }
//  const document = ""
//  const view = new View();
//  for (let prop in view) {
//      console.log(prop);
//  }


const symbol = Symbol("on");
// @BookCollector()
// export default class {}

function BookCollector (options = {}) {
    return function decorator (target) {
        console.log("symbol", target.elements[2].descriptor[symbol]);
        // console.log(target.elements.find(({ key }) => key === "log").descriptor[symbol]);
        console.log("vai filhao", ...arguments);
        target.finisher = factory;
    };

    function factory (Class) {
        return class Finisher extends Class {

            constructor (...args) {
                super(...args);
                console.log("finisher", this);
            }

            collect () {
                console.log("collect", this);
            }

            log (...args) {
                console.log("Finisher.log", this, ...args);
                if (super.log) {
                    super.log(...args);
                }
            }

        };
    }
}

function On (event) {
    return (target) => {
        target.oioioi = 123456;
        target.descriptor[symbol] = {
            ...target.descriptor[symbol],
            [event]: `${event} 1111111111111111111111111`,
        };
        console.log(target);
    };
}

// Object.defineProperty(On, "symbol", {
//     configurable: true,
//     enumerable: true,
//     value: symbol,
//     writable: true,
// });


function enumerable (target) {
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

    log (...args) {
        console.log("Person.log", this, ...args);
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

    @On("event selector")
    @On("event selector2")
    @On("event selector3")
    log (...args) {
        console.log("Lucas.log", this, ...args);
        //   super.log(...args);
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
// console.log(lucas);
// lucas.collect();
// lucas.study();
// lucas.render();

// for (const key in lucas) {
//     if (Object.prototype.hasOwnProperty.call(lucas, key)) {
//         console.log(key, lucas[key]);
//     }
// }

// const marques = new Marques();

// marques.log("marques log");
// marques.study();
// marques.render();

function Meta (options = {}) {
    return function decorator (target) {
        console.log("symbol", target.elements[2].descriptor[symbol]);
        // console.log(target.elements.find(({ key }) => key === "log").descriptor[symbol]);
        console.log("vai filhao", ...arguments);
        target.finisher = factory;
    };
}

const model = Symbol("model");
const ExtendedModel = Symbol("ExtendedModel");

/**
 * Backbone **Models** are the basic data object in the framework
 * frequently representing a row in a table in a database on your
 * server.
 * A discrete chunk of data and a bunch of useful, related methods for
 * performing computations and transformations on that data.
 * @typedef Model
 * @class
 * @see {@link http://backbonejs.org/#Model}
 */
class Model {

    /**
     * Model decorator.
     * @param {object} options The model's definition.
     * @param {string} [options.idAttribute=id] The name of attribute that
     * identifies the model instance.
     * @param {string} [options.cidPrefix=c] The prefix is used to create the
     * client id which is used to identify models locally.
     * You may want to override this if you're experiencing name clashes with
     * model ids.
     * @param {function} [options.initialize] Define the initialization logic.
     * @returns {function} a function that mixes the class with a Backbone.Model
     * proxy.
     */
    static extend (options = {}) {
        return function decorator (target) {
            target.elements.push({
                descriptor: {
                    configurable: false,
                    enumerable: false,
                    value: Backbone.Model.extend(options),
                    writable: false,
                },
                key: ExtendedModel,
                kind: "method",
                placement: "prototype",
            });
        };
    }

    /**
     * Create a point.
     * @param {number} attributes The x value.
     * @param {number} options The y value.
     */
    constructor (attributes, options) {
        this[model] = new this[ExtendedModel](attributes, options);

        console.log(this[model]);
    }

    /**
     * A hash of attributes whose current and previous value differ.
     * @type {object}
     */
    get changed () {
        return this[model].changed;
    }

    /**
     * idAttribute
     * @type {string}
     */
    get idAttribute () {
        return this[model].idAttribute;
    }

    /**
     * The prefix is used to create the client id which is used to
     * identify models locally.
     * You may want to override this if you're experiencing name
     * clashes with model ids.
     * @type {string}
     */
    get cidPrefix () {
        return this[model].cidPrefix;
    }

    /**
     * @returns {object} a plain object representing the model state
     */
    toJSON () {
        return this[model].toJSON();
    }

    /**
     * Get the value of an attribute.
     * @param {string} attr The attribute's name
     * @returns {any} The attribute's value
     */
    get (attr) {
        return this[model].get(attr);
    }

    /**
     * Get the HTML-escaped value of an attribute.
     * @param {string} attr The attribute's name
     * @returns {any} The HTML-escaped attribute's value
     */
    escape (attr) {
        return this[model].escape(attr);
    }

    /**
     * @param {string} attr The attribute's name
     * @returns {boolean} `true` if the attribute contains a value that
     * is not null or undefined.
     * */
    has (attr) {
        return this[model].has(attr);
    }

    /**
     * Test if the model's attributes contains all
     * of the key/value properties present in attrs.
     * @param {object} attrs used to check
     * @return {boolean} `true`
     */
    matches (attrs) {
        return this[model].matches(attrs);
    }

    /**
     * The names of the object's own enumerable properties.
     * @type {array.<string>}
     * @see {@link https://underscorejs.org/#keys}
     */
    get keys () {
        return this[model].keys();
    }

    /**
     * The values of the object's own properties.
     * @type {array.<any>}
     * @see {@link https://underscorejs.org/#values}
     */
    get values () {
        return this[model].values();
    }

    /**
     * A list of [key, value] pairs. The opposite of object.
     * @type {array.<array.<any>>}
     * @see {@link https://underscorejs.org/#pairs}
     */
    get pairs () {
        return this[model].pairs();
    }

    /**
     * A copy of the object where the keys have become the values and
     * the values the keys. For this to work, all of your object's
     * values should be unique and string serializable.
     * @type {object}
     * @see {@link https://underscorejs.org/#invert}
     */
    @On("123")
    get invert () {
        return this[model].invert();
    }

    /**
     * A copy of the model's attributes, filtered to only have
     * values for the whitelisted keys (or array of valid keys).
     * Alternatively accepts a predicate indicating which keys to pick.
     * @see {@link https://underscorejs.org/#invert}
     * @returns {object} Filtered Model's attributes.
     */
    pick (...args) {
        return this[model].pick(...args);
    }

    /**
     * A copy of the model's attributes, filtered to omit the
     * blacklisted keys (or array of keys). Alternatively accepts
     * a predicate indicating which keys to omit.
     * @see {@link https://underscorejs.org/#omit}
     * @param {...string|function} keys The keys or a filter.
     * @returns {object} Filtered Model's attributes.
     */
    omit (...keys) {
        return this[model].omit(...keys);
    }

    /**
     * Check if the model's attributes contains no values (no
     * enumerable own-properties).
     * @see {@link https://underscorejs.org/#omit}
     * @returns {boolean} `true` if contains no values.
     */
    get isEmpty () {
        return this[model].isEmpty();
    }

    /**
     * Wrap the model's attributes into the underscore chain api.
     * @see {@link https://underscorejs.org/#chain}
     * @returns {object} the attributes wrapped by _.chain.
     */
    chain () {
        return this[model].chain();
    }

}

@Model.extend({

})
class Bernardo extends Model {

}

const ber1 = new Bernardo();
const ber2 = new Bernardo();
const ber3 = new Bernardo();
const ber4 = new Bernardo();
