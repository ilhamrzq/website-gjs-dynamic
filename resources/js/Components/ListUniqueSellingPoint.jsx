import '../assets/css/listUniqueSellingPoint.css';

export default function ListUniqueSellingPoint({ imgSellingPoint1, imgSellingPoint2, imgSellingPoint3, titleSellingPoint1, titleSellingPoint2, titleSellingPoint3, descSellingPoint1, descSellingPoint2, descSellingPoint3 }) {
  return (
    <section>
      <div className="grid grid-flow-row">
        {/* Selling Point 1 */}
        <div className="selling-point-1">
          <div className="grid grid-flow-row md:grid-flow-col md:grid-cols-2">
            <div className="col-span-1 w-11/12 md:w-full mx-auto">
              <img src={imgSellingPoint1} className="w-full rounded-selling-point-1" alt="Selling Point 1" />
            </div>
            <div className="col-span-1 self-start md:self-center my-4">
              <div className="w-11/12 md:w-10/12 mx-auto">
                <h1 className="font-bold fs-24 md:text-[40px] color-primary-blue-100">{titleSellingPoint1}</h1>
                <p className="text-subtitle">{descSellingPoint1}</p>
              </div>
            </div>
          </div>
        </div>
        {/* End Selling Point 1 */}

        {/* Selling Point 2 */}
        <div className="selling-point-2 my-10 md:my-0">
          <div className="flex flex-col-reverse md:grid md:grid-flow-col md:grid-cols-2 gap-4">
            <div className="col-span-1 self-center w-11/12 md:w-10/12 mx-auto">
              <div className="w-full md:w-10/12 mx-auto">
                <h1 className="font-bold fs-24 md:text-[40px] color-primary-blue-100">{titleSellingPoint2}</h1>
                <p className="text-subtitle">{descSellingPoint2}</p>
              </div>
            </div>
            <div className="col-span-1 w-11/12 md:w-full mx-auto">
              <img src={imgSellingPoint2} className="w-full rounded-selling-point-2" alt="Selling Point 2" />
            </div>
          </div>
        </div>
        {/* End Selling Point 2 */}

        {/* Selling Point 3 */}
        <div className="selling-point-3">
          <div className="grid grid-flow-row md:grid-flow-col md:grid-cols-2 gap-4">
            <div className="col-span-1 w-11/12 md:w-full mx-auto">
              <img src={imgSellingPoint3} className="w-full rounded-selling-point-3" alt="Selling Point 3" />
            </div>
            <div className="col-span-1 self-center">
              <div className="w-11/12 md:w-10/12 mx-auto">
                <h1 className="font-bold fs-24 md:text-[40px] color-primary-blue-100">{titleSellingPoint3}</h1>
                <p className="text-subtitle">{descSellingPoint3}</p>
              </div>
            </div>
          </div>
        </div>
        {/* End Selling Point 3 */}
      </div>
    </section>
  );
}
