import { RequestHandler } from "express";
import { HttpMethod } from "./HttpMethod";

export class RouterController {
    constructor(
        public method: HttpMethod,
        public path: string,
        public middlewares: RequestHandler[] = [],
        public handler: RequestHandler
    ) { }
}