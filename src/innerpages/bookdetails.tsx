import React, {
  useState,
  useEffect,
  useCallback,
  useRef,
  startTransition,
  memo,
  forwardRef,
} from "react";
import { Document, Page, pdfjs } from "react-pdf";
import HTMLFlipBook from "react-pageflip";
import BookCover from "../assets/images/book-cover.webp";
import { GrFormPrevious } from "react-icons/gr";
import { GrFormNext } from "react-icons/gr";

import "react-pdf/dist/Page/AnnotationLayer.css";
import "react-pdf/dist/Page/TextLayer.css";

// PDF Worker
pdfjs.GlobalWorkerOptions.workerSrc = `//unpkg.com/pdfjs-dist@${pdfjs.version}/build/pdf.worker.min.mjs`;

const A4_RATIO = 1.414;
const FREE_PAGES_LIMIT = 15; // User can read only up to page 6, then "Buy Now" page
const TOTAL_FLIPBOOK_PAGES = 1 + FREE_PAGES_LIMIT + 1; // cover + 6 PDF + Buy Now page

/* ================= PAGE ================= */
interface PageProps {
  pageNumber: number;
  width: number;
  height: number;
}

const PageWrapper = memo(
  forwardRef<HTMLDivElement, PageProps>(
    ({ pageNumber, width, height }, ref) => (
      <div className="book-page" ref={ref} data-density="soft">
        <div className="page-content">
          <Page
            pageNumber={pageNumber}
            width={width}
            height={height}
            renderTextLayer={false}
            renderAnnotationLayer={false}
            loading={
              <div className="page-loader">
                <div className="mini-spinner" />
              </div>
            }
          />
          <div className="page-shadow" />
        </div>
      </div>
    )
  )
);

/* ================= COVER ================= */
const Cover = memo(
  forwardRef<HTMLDivElement, {}>(({}, ref) => (
    <div className="book-page cover-front" ref={ref} data-density="hard">
      <div className="page-content">
        <div
          className="cover-inner"
          style={{ backgroundImage: `url(${BookCover})` }}
        >
         
        </div>  
        <div className="page-shadow" />
      </div>
    </div>
  ))
);

/* ================= BUY NOW PAGE ================= */
const BuyNowPage = memo(
  forwardRef<HTMLDivElement, {}>(({}, ref) => (
    <div className="book-page book-buy-now-page" ref={ref} data-density="soft">
      <div className="page-content">
        <div className="book-buy-now-page-inner">
          <p className="book-buy-now-text">Enjoyed the preview? Get the full book to continue reading.</p>
          <a href="https://www.amazon.com/World-2050-Salman-Waria-ebook/dp/B0GFY23QP2/ref=tmm_kin_swatch_0?_encoding=UTF8&dib_tag=se&dib=eyJ2IjoiMSJ9.PBG-mFrGUgrl94o4BOCVQuho7yuCOrzXme6rU20aCZxHaHiw2fU9rWgPR4Ebh2bIRJU9e19YVEvgDbqkDtFQkXxAc4ai9Fr7i4iUNh0splXb-i3kc6eYs7moZ5I4tg0VQjS_OR5E9zgQCyZgLKGSgPJ1WgRYoBZjgNvIUA2QLUi5CsE2E5rkrSRCP4bkGe_ynMrQfkjFKvAQH-nfdZ_SCs8Oq0ByiZIt5oUb5_RAHwQ.SuN81h4m0UJJZ57Vd6YP6Un2dcLDznSwFaP4XCah8Dc&qid=1770239182&sr=1-1" target="_blank" className="book-buy-now-btn">
            Buy Now just for $9.99
          </a>
        </div>
        <div className="page-shadow" />
      </div>
    </div>
  ))
);

/* ================= MAIN ================= */
const BookDetails: React.FC = () => {
  const [numPages, setNumPages] = useState<number | null>(null);
  const [currentPage, setCurrentPage] = useState(0);
  const [isMobile, setIsMobile] = useState(window.innerWidth < 768);
  const [dimensions, setDimensions] = useState({ width: 550, height: 750 });

  const flipBookRef = useRef<any>(null);

  /* ---------- Resize ---------- */
  const handleResize = useCallback(() => {
    const width = window.innerWidth;
    const mobile = width < 768;

    setIsMobile(mobile);

    const pageWidth = mobile
      ? Math.min(width - 20, 450)
      : Math.min((width - 240) / 2, 550);

    setDimensions({
      width: Math.floor(pageWidth),
      height: Math.floor(pageWidth * A4_RATIO),
    });
  }, []);

  useEffect(() => {
    handleResize();
    const resizeListener = () => {
      clearTimeout((window as any).__resizeTimer);
      (window as any).__resizeTimer = setTimeout(handleResize, 100);
    };
    window.addEventListener("resize", resizeListener);
    return () => window.removeEventListener("resize", resizeListener);
  }, [handleResize]);

  /* ---------- PDF Load ---------- */
  const onDocumentLoadSuccess = ({ numPages }: { numPages: number }) =>
    startTransition(() => setNumPages(numPages));

  /* ---------- Navigation ---------- */
  const lastAllowedPage = TOTAL_FLIPBOOK_PAGES - 1; // last page = Buy Now (index 7)

  const flip = (dir: "next" | "prev") =>
    flipBookRef.current?.pageFlip()[dir === "next" ? "flipNext" : "flipPrev"]();

  const handleFlip = useCallback(
    (e: { data: number }) => {
      const nextPage = e.data;
      if (nextPage > lastAllowedPage) {
        flipBookRef.current?.pageFlip()?.turnToPage(lastAllowedPage);
        return;
      }
      setCurrentPage(nextPage);
    },
    [lastAllowedPage]
  );

  const flipbookKey = isMobile ? "mobile" : "desktop";

  return (
    <div className="book-details-viewer">
      <div className="viewer-container">
        <h1 className="book-viewer-heading">WORLD, IN 2050</h1>

        <Document
          file="/book.pdf"
          onLoadSuccess={onDocumentLoadSuccess}
          loading={<div className="book-loader">Opening Book...</div>}
        >
          {numPages && (
            <div className="flipbook-wrapper">
              {!isMobile && <div className="" />}
              <button
                className="nav-arrow prev"
                onClick={() => flip("prev")}
                disabled={currentPage === 0}
              >
                <GrFormPrevious size={30}/>
              </button>

              <HTMLFlipBook
                key={flipbookKey}
                ref={flipBookRef}
                width={dimensions.width}
                height={dimensions.height}
                minWidth={200}
                maxWidth={800}
                minHeight={280}
                maxHeight={1130}
                size="fixed"
                startPage={0}
                drawShadow
                flippingTime={isMobile ? 600 : 800}
                usePortrait={isMobile}
                startZIndex={0}
                maxShadowOpacity={1}
                showCover
                autoSize
                mobileScrollSupport
                clickEventForward
                useMouseEvents
                onFlip={handleFlip}
                swipeDistance={isMobile ? 15 : 30}
                showPageCorners={!isMobile}
                disableFlipByClick={false}
                className="pdf-flipbook"
                style={{ backgroundColor: "transparent" }}
              >
                <Cover  />

                {Array.from({ length: Math.min(numPages, FREE_PAGES_LIMIT) }).map((_, i) => (
                  <PageWrapper
                    key={i}
                    pageNumber={i + 1}
                    width={dimensions.width}
                    height={dimensions.height}
                  />
                ))}
                <BuyNowPage />
              </HTMLFlipBook>

              <button
                className="nav-arrow next"
                onClick={() => flip("next")}
                disabled={currentPage >= lastAllowedPage}
              >
                <GrFormNext  size={30}/>
              </button>
            </div>
          )}
        </Document>
{/* Page counter */}

        {/* {numPages && (
          <div className="page-counter">
            {isMobile
              ? `Page ${currentPage + 1} of ${TOTAL_FLIPBOOK_PAGES}`
              : `Pages ${currentPage + 1}-${Math.min(
                  currentPage + 2,
                  TOTAL_FLIPBOOK_PAGES
                )} of ${TOTAL_FLIPBOOK_PAGES}`}
          </div>
        )} */}
      </div>
    </div>
  );
};

export default BookDetails;